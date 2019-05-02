<?php
namespace cipherfinder;
final class TripleDesCfbCipher extends TripleDesCipher
{
	function __construct($key)
	{
		parent::__construct($key, "cfb");
	}
}
