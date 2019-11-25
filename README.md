# CipherFinder [![Build Status](https://travis-ci.org/hell-sh/cipherfinder.svg?branch=master)](https://travis-ci.org/hell-sh/cipherfinder)

CipherFinder tries to identify the steps that occurred between plaintext and ciphertext.

## Usage

If you have [Cone](https://getcone.org/), you can simply `cone get cipherfinder` and then use the `cipherfinder` command.

### Example

    $ cipherfinder -c "Z3ywI2xbRQSzkFm5RZ==" -p "Hello, world!"
    Trying 27 ciphers until depth 7.
    Trying depth 2/7.
    Trying depth 3/7.
    Found a working cipher combo: ciphertext -> rot17 -> base64 -> rot5 -> plaintext

### Without Cone

	git clone https://github.com/hell-sh/cipherfinder
	cd cipherfinder
	composer install --no-dev

and then you can use `php cipherfinder.php` in the newly-created cipherfinder folder.
