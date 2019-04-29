<?php
namespace cipherfinder;
class OpensslCipher extends Cipher
{
	protected $method;
	protected $key;
	protected $flags;

	function __construct($method, $key, bool $no_padding)
	{
		$this->method = $method;
		$this->key = $key;
		$this->flags = OPENSSL_RAW_DATA;
		if($no_padding)
		{
			$this->flags |= OPENSSL_ZERO_PADDING;
		}
	}

	function decode($ciphertext)
	{
		return @openssl_decrypt($ciphertext, $this->method, $this->key, $this->flags);
	}
}
