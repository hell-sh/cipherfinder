<?php
require __DIR__.'/../vendor/autoload.php';
use cipherfinder\{Base64Cipher, CipherFinder, HexCipher, XorCipher};
use PHPUnit\Framework\TestCase;
final class CipherTest extends TestCase
{
	function testBase64Cipher()
	{
		$this->assertEquals("Hello, world!", (new Base64Cipher())->decrypt("SGVsbG8sIHdvcmxkIQ=="));
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
