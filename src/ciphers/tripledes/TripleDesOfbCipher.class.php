<?php
namespace cipherfinder;
final class TripleDesOfbCipher extends TripleDesCipher
{
	function __construct($key)
	{
		parent::__construct($key, "ofb");
	}
}
