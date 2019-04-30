<?php
namespace cipherfinder;
class HexCipher extends Cipher
{
	function decode($ciphertext)
	{
		return @hex2bin($ciphertext);
	}
}
