<?php
require __DIR__."/../vendor/autoload.php";
use cipherfinder\{Base64Cipher, CipherFinder, HexCipher, TripleDesEcbCipher, XorCipher};
class CipherTest
{
	function testBase64Cipher()
	{
		Nose::assertEquals((new Base64Cipher())->decrypt("SGVsbG8sIHdvcmxkIQ=="), "Hello, world!");
	}

	function testTripleDesCipher()
	{
		Nose::assertEquals((new TripleDesEcbCipher("Hi"))->decrypt(hex2bin("6560df51b8b406eb4474a95a1b9dafc8")), "Hello, world!");
	}

	function testHexCipher()
	{
		Nose::assertEquals((new HexCipher())->decrypt("0f"), "\x0F");
	}

	function testXorCipher()
	{
		Nose::assertEquals((new XorCipher(CipherFinder::padKey("XOR", 13)))->decrypt(hex2bin("102a3e34207e78383d2a233679")), "Hello, world!");
	}
}
