# CipherFinder [![Build Status](https://travis-ci.org/hell-sh/cipherfinder.svg?branch=master)](https://travis-ci.org/hell-sh/cipherfinder)

CipherFinder tries to identify the steps that occurred between plaintext and ciphertext.

**CipherFinder is still in its infancy.** Any issues and pull requests are highly appreciated.

## Using the CLI tool

	git clone https://github.com/hell-sh/cipherfinder
	cd cipherfinder
	composer install --no-dev
	php cipherfinder.php -?

### Example

    $ php cipherfinder.php -c "Z3ywI2xbRQSzkFm5RZ==" -p "Hello, world!"
    Trying depth 1/7.
    Trying depth 2/7.
    Trying depth 3/7.
    Found a working cipher combo: ciphertext -> rot17 -> base64 -> rot5 -> plaintext
