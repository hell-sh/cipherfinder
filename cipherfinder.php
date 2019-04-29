<?php
/** @noinspection PhpUnhandledExceptionInspection */
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
	"max-depth" => [
		"alias" => "l",
		"default" => 7,
		"filter" => "int",
		"help" => "The maximum size of the cipher combo. Defaults to 7."
	],
	"key" => [
		"alias" => "k",
		"help" => "An encryption key which may have been used."
	]
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
}
$cf = new CipherFinder($args->getArg("ciphertext"), $args->getArg("plaintext"), $keys);
$cf->onNewDepth(function($depth, $max_depth)
{
	echo "Trying depth {$depth}/{$max_depth}.\r\n";
});
$ret = $cf->findCiphers($args->getArg("max-depth"));
if($ret)
{
	echo "Found a working cipher combo: ciphertext -> ".join(" -> ", $ret)." -> plaintext\r\n";
}
else
{
	echo "Unable to find a working cipher combo.";
}
