<?php
namespace cipherfinder;
final class TripleDes3CbcCipher extends TripleDesCipher
{
	function __construct($key)
	{
		parent::__construct($key, "3cbc");
	}
}
