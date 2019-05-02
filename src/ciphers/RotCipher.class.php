<?php
namespace cipherfinder;
class RotCipher extends Cipher
{
	const letters = 'AaBbCcDdEeFfGgHhIiJjKkLlMmNnOoPpQqRrSsTtUuVvWwXxYyZz';
	protected $n;
	protected $rep;

	function __construct($n)
	{
		$this->n = $n;
		if($this->n != 13)
		{
			$this->rep = substr(self::letters, $this->n * 2).substr(self::letters, 0, $this->n * 2);;
		}
	}

	function decrypt($ciphertext)
	{
		return $this->n == 13 ? str_rot13($ciphertext) : strtr($ciphertext, self::letters, $this->rep);
	}
}
