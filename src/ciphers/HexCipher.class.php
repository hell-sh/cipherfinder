<?php
namespace cipherfinder;
class HexCipher extends Cipher
{
	function decrypt($ciphertext)
	{
		return @hex2bin($ciphertext);
	}
}
