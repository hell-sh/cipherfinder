# CipherFinder

CipherFinder tries to identify the steps that occurred between plaintext and ciphertext.

**Note:** Currently, CipherFinder is **far** from complete, merely supporting Base64, ROT 1-25, and all openssl ciphers (which require a key to be provided). As such, any issues and pull requests would be highly appreciated.

## Using the CLI tool

	git clone https://github.com/hell-sh/cipherfinder
	cd cipherfinder
	composer install --no-dev
	php cipherfinder.php -?
