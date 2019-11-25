<?php
require __DIR__."/../vendor/autoload.php";
use cipherfinder\CipherFinder;
class GeneralTest
{
	function testKey2Readable()
	{
		Nose::assertEquals(CipherFinder::key2readable("\x0F"), "0x0f");
		Nose::assertEquals(CipherFinder::key2readable("hi"), "'hi'");
	}

	function testPadKey()
	{
		Nose::assertEquals(CipherFinder::padKey("Test", 13), "TestTestTestT");
	}
}
