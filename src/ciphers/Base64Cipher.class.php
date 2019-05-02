<?php
namespace cipherfinder;
class Base64Cipher extends Cipher
{
	function decrypt($ciphertext)
	{
		return base64_decode($ciphertext);
	}
}
