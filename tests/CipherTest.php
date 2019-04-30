<?php
require __DIR__.'/../vendor/autoload.php';
use cipherfinder\{Base64Cipher, CipherFinder, HexCipher, XorCipher};
use PHPUnit\Framework\TestCase;
final class CipherTest extends TestCase
{
	function testBase64Cipher()
	{
		$this->assertEquals("Hello, world!", (new Base64Cipher())->decode("SGVsbG8sIHdvcmxkIQ=="));
	}

	function testHexCipher()
	{
		$this->assertEquals("\x0F", (new HexCipher())->decode("0f"));
	}

	function testXorCipher()
	{
		$this->assertEquals("Hello, world!", (new XorCipher(CipherFinder::padKey("XOR", 13)))->decode(hex2bin("102a3e34207e78383d2a233679")));
	}
}
