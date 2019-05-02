<?php
require __DIR__.'/../vendor/autoload.php';
use cipherfinder\{Base64Cipher, CipherFinder, HexCipher, TripleDesEcbCipher, XorCipher};
use PHPUnit\Framework\TestCase;
final class CipherTest extends TestCase
{
	function testBase64Cipher()
	{
		$this->assertEquals("Hello, world!", (new Base64Cipher())->decrypt("SGVsbG8sIHdvcmxkIQ=="));
	}

	function testTripleDesCipher()
	{
		$this->assertEquals("Hello, world!", (new TripleDesEcbCipher("Hi"))->decrypt(hex2bin("6560df51b8b406eb4474a95a1b9dafc8")));
	}

	function testHexCipher()
	{
		$this->assertEquals("\x0F", (new HexCipher())->decrypt("0f"));
	}

	function testXorCipher()
	{
		$this->assertEquals("Hello, world!", (new XorCipher(CipherFinder::padKey("XOR", 13)))->decrypt(hex2bin("102a3e34207e78383d2a233679")));
	}
}
