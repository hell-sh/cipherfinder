<?php
require __DIR__.'/../vendor/autoload.php';
use cipherfinder\HexCipher;
use PHPUnit\Framework\TestCase;
final class CipherTest extends TestCase
{
	function testHexCipher()
	{
		$this->assertEquals("\x0F", (new HexCipher())->decode("0f"));
	}
}
