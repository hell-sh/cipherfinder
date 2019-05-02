<?php
namespace cipherfinder;
class XorCipher extends KeyCipher
{
	protected $key_length;

	function __construct($key)
	{
		$this->key_length = strlen($key);
		$key = str_split($key);
		for($i = 0; $i < $this->key_length; $i++)
		{
			$key[$i] = ord($key[$i]);
		}
		parent::__construct($key);
	}

	function decrypt($ciphertext)
	{
		if(strlen($ciphertext) != $this->key_length)
		{
			return false;
		}
		$ciphertext = str_split($ciphertext);
		$plaintext = '';
		for($i = 0; $i < $this->key_length; $i++)
		{
			$plaintext .= chr($this->key[$i] ^ ord($ciphertext[$i]));
		}
		return $plaintext;
	}
}
