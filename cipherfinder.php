<?php
/** @noinspection PhpUnhandledExceptionInspection PhpUnusedParameterInspection */
require "vendor/autoload.php";
use cipherfinder\CipherFinder;
$args = new CliArgs\CliArgs([
	"help" => [
		"alias" => "?",
		"filter" => "flag",
		"help" => "Shows this help."
	],
	"ciphertext" => "c",
	"plaintext" => "p",
	"key" => [
		"alias" => "k",
		"help" => "An encryption key which may have been used."
	],
	"max-depth" => [
		"alias" => "l",
		"default" => 7,
		"filter" => "int",
		"help" => "The maximum size of the cipher combo. Defaults to 7."
	],
]);

if($args->isFlagExist("help") || !$args->isFlagExist("ciphertext") || !$args->isFlagExist("plaintext"))
{
	die($args->getHelp());
}
$keys = [];
if($args->isFlagExist("key"))
{
	array_push($keys, $args->getArg("key"));
	$keys += CipherFinder::inferKeys($keys);
	if(count($keys) > 1)
	{
		echo "Inferred ".(count($keys) - 1)." additional keys.\r\n";
	}
}
$cf = new CipherFinder($args->getArg("ciphertext"), $args->getArg("plaintext"), $keys);
$max_depth = $args->getArg("max-depth");
if($max_depth < 1)
{
	$max_depth = 1;
}
if(count($keys) < 2)
{
	echo "Trying ".count($cf->allCiphers())." ciphers";
	if($max_depth > 1)
	{
		echo " until depth ".$max_depth;
	}
	echo ".\r\n";
}
else
{
	echo "Trying ".count((new CipherFinder("", "", [""]))->allCiphers())." ciphers";
	if($max_depth > 2)
	{
		echo " until depth ".$max_depth;
	}
	echo ".\r\n";
}
$cf->onNewDepth(function($depth, $max_depth)
{
	if($depth > 1)
	{
		echo "Trying depth {$depth}.\r\n";
	}
});
$ret = $cf->findCiphers($max_depth);
if($ret)
{
	echo "Found a working cipher combo: ciphertext -> ".join(" -> ", $ret)." -> plaintext\r\n";
}
else
{
	echo "Unable to find a working cipher combo.";
}
