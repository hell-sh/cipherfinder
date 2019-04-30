<?php
namespace cipherfinder;
abstract class KeyCipher extends Cipher
{
	protected $key;

	function __construct($key)
	{
		$this->key = $key;
	}
}
