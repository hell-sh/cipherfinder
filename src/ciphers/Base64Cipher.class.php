<?php
namespace cipherfinder;
class Base64Cipher extends Cipher
{
	function decode($ciphertext)
	{
		return base64_decode($ciphertext);
	}
}
