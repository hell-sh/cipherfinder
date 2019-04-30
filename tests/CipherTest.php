<?php
require __DIR__.'/../vendor/autoload.php';
use cipherfinder\{Base64Cipher, HexCipher};
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
}
