<?php
namespace cipherfinder;
final class TripleDesEcbCipher extends TripleDesCipher
{
	function __construct($key)
	{
		parent::__construct($key, "ecb");
	}
}
