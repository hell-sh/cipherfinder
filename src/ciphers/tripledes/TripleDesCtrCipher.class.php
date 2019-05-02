<?php
namespace cipherfinder;
final class TripleDesCtrCipher extends TripleDesCipher
{
	function __construct($key)
	{
		parent::__construct($key, "ctr");
	}
}
