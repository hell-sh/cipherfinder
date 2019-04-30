<?php
require __DIR__.'/../vendor/autoload.php';
use cipherfinder\{CipherFinder, HexCipher};
use PHPUnit\Framework\TestCase;
final class CipherFinderTest extends TestCase
{
	function testKey2readable()
	{
		$this->assertEquals("0x0f", CipherFinder::key2readable("\x0F"));
		$this->assertEquals("'hi'", CipherFinder::key2readable("hi"));
	}

	function testHexCipher()
	{
		$this->assertEquals("\x0F", (new HexCipher())->decode("0f"));
	}
}
