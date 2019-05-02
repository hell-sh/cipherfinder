<?php
namespace cipherfinder;
final class TripleDesCbcCipher extends TripleDesCipher
{
	function __construct($key)
	{
		parent::__construct($key, "cbc");
	}
}
