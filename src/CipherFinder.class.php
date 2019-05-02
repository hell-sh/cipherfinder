<?php
namespace cipherfinder;
use Exception;
use InvalidArgumentException;
use hellsh\UUID;
final class CipherFinder
{
	public $ciphertext;
	public $plaintext;
	public $keys = [];
	/**
	 * The function called when a new depth is being tried
	 * @var callable $new_depth_handler
	 */
	public $new_depth_handler;
	protected $ciphers = null;
	protected $rot_ciphers = null;
	protected $key_ciphers = null;

	function __construct($ciphertext, $plaintext, array $keys = [])
	{
		$this->ciphertext = $ciphertext;
		$this->plaintext = $plaintext;
		$this->keys = $keys;
		$this->new_depth_handler = function($depth, $max_depth){};
		$this->ciphers = [
			'base64' => new Base64Cipher(),
			'hex' => new HexCipher()
		];
		$this->rot_ciphers = [];
		for($i = 1; $i <= 25; $i++)
		{
			$this->rot_ciphers["rot{$i}"] = new RotCipher($i);
		}
		$this->key_ciphers = [];
		foreach($this->keys as $key)
		{
			$padded = self::padKey($key, strlen($this->plaintext));
			$readable = self::key2readable($key);
			$padded_readable = self::key2readable($padded);
			$this->key_ciphers["xor({$padded_readable})"] = new XorCipher($padded);
			foreach(openssl_get_cipher_methods(false) as $method)
			{
				$this->key_ciphers["{$method}({$readable})"] = new OpensslCipher($key, $method, true);
				$this->key_ciphers["{$method}-pkcs7({$readable})"] = new OpensslCipher($key, $method, false);
			}
		}
	}

	static function key2readable($key)
	{
		return ctype_print($key) ? "'{$key}'" : '0x'.bin2hex($key);
	}

	static function padKey($key, $len)
	{
		while(strlen($key) < $len)
		{
			$key .= $key;
		}
		return substr($key, 0, $len);
	}

	/**
	 * Uses the given key(s) to (potentially) infer further keys.
	 * @param array $keys
	 * @return array All inferred keys.
	 */
	static function inferKeys(array $keys = []) : array
	{
		$ret = [];
		foreach($keys as $key)
		{
			try
			{
				$uuid = new UUID($key);
				$plain = $uuid->toString(false);
				$dashed = $uuid->toString(true);
				if($key != $plain)
				{
					array_push($ret, $plain);
				}
				if($key != $dashed)
				{
					array_push($ret, $dashed);
				}
				if($key != $uuid->binary)
				{
					array_push($ret, $uuid->binary);
				}
			}
			catch(InvalidArgumentException $e)
			{
			}
		}
		return $ret;
	}

	/**
	 * Sets the function to be called when a new depth is being tried.
	 * @param callable $callable
	 */
	function onNewDepth(callable $callable)
	{
		$this->new_depth_handler = $callable;
	}

	function allCiphers() : array
	{
		return $this->ciphers + $this->key_ciphers + $this->rot_ciphers;
	}

	private function getCiphers(Cipher $prev_cipher = null) : array
	{
		$ciphers = $this->ciphers;
		if(!$prev_cipher instanceof RotCipher)
		{
			$ciphers += $this->rot_ciphers;
		}
		if($this->keys)
		{
			$ciphers += $this->key_ciphers;
		}
		return $ciphers;
	}

	/**
	 * @param integer $max_depth
	 * @return boolean|array
	 * @throws Exception
	 */
	function findCiphers(int $max_depth = 7)
	{
		for($depth = 1; $depth <= $max_depth; $depth++)
		{
			($this->new_depth_handler)($depth, $max_depth);
			if($ret = $this->findCiphers_($depth, $this->ciphertext))
			{
				return $ret;
			}
		}
		return false;
	}

	/**
	 * @param integer $depth
	 * @param $ciphertext
	 * @param array $cipherlist
	 * @param Cipher $prev_cipher
	 * @return boolean|array
	 * @throws Exception
	 */
	private function findCiphers_(int $depth, $ciphertext, array $cipherlist = [], Cipher $prev_cipher = null)
	{
		$go_deeper = --$depth > 0;
		foreach($this->getCiphers($prev_cipher) as $ciphername => $cipher)
		{
			$ciphertext_ = $cipher->decrypt($ciphertext);
			if($ciphertext_ == $this->plaintext)
			{
				$cipherlist_ = $cipherlist;
				array_push($cipherlist_, $ciphername);
				return $cipherlist_;
			}
			if($go_deeper)
			{
				$cipherlist_ = $cipherlist;
				array_push($cipherlist_, $ciphername);
				if($ret = $this->findCiphers_($depth, $ciphertext_, $cipherlist_, $cipher))
				{
					return $ret;
				}
			}
		}
		return false;
	}
}
