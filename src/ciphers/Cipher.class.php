<?php
namespace cipherfinder;
abstract class Cipher
{
	abstract function decode($ciphertext);
}
