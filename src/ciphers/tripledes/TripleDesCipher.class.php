<?php
namespace cipherfinder;
use phpseclib\Crypt\TripleDES;
abstract class TripleDesCipher extends KeyCipher
{
	/**
	 * @var TripleDES $des
	 */
	private $des;

	function __construct($key, $mode)
	{
		parent::__construct($key);
		$this->des = new TripleDES($mode);
		$this->des->setKey($key);
	}

	function decrypt($ciphertext)
	{
		return @$this->des->decrypt($ciphertext);
	}
}
