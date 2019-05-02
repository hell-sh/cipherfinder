<?php
namespace cipherfinder;
class OpensslCipher extends KeyCipher
{
	protected $method;
	protected $flags;

	function __construct($key, $method, bool $no_padding)
	{
		parent::__construct($key);
		$this->method = $method;
		$this->flags = OPENSSL_RAW_DATA;
		if($no_padding)
		{
			$this->flags |= OPENSSL_ZERO_PADDING;
		}
	}

	function decrypt($ciphertext)
	{
		return @openssl_decrypt($ciphertext, $this->method, $this->key, $this->flags);
	}
}
