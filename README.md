# About

This is an example of data encryption using AES and RSA encryption systems with JS and PHP.

The data filled in the web form is encrypted and sent to the server, which decrypts and sends it back to the browser.

## What is AES?

Advanced Encryption Standard (AES) is a symmetric block cipher chosen by the U.S. government to protect data.

Each cipher encrypts and decrypts data in blocks of 128 bits.

This cryptographic system includes three block ciphers:

1. AES-128 uses a 128-bit key length
2. AES-192 uses a 192-bit key length
3. AES-256 uses a 256-bit key length

Symmetric ciphers use the same key to encrypt and decrypt. The sender and recipient must know and use the same secret key.

## What is RSA?

Rivest–Shamir–Adleman (RSA) is a cryptographic system that unlike AES, is based on asymmetric cryptography.

The term asymmetric comes from the fact that there are two related keys used for encryption: a public and a private key. If encryption is performed with the public key, decryption can only happen with the related private key and vice versa. Typically, RSA keys are employed when there are two separate endpoints.

While RSA encryption works well for protecting the transfer of data across geographic boundaries, its performance is poor. The solution is to combine RSA encryption with AES encryption in order to combine the benefit the security of RSA with the performance of AES. This can be accomplished by generating a temporary AES key and protecting it with RSA encryption.

# Download OpenSSL

To generate the keys it is necessary to have OpenSSL installed on your machine.

## Windows

If you already have Git, you don't need to do anything else, because the OpenSSL executable can be found at:

`C:\Program Files\Git\usr\bin\openssl.exe`

If you have chocolatey installed you can install openssl via a single command:

```bash
choco install openssl
```

If none of the above are suitable for you, you can download the executable [here](https://slproweb.com/products/Win32OpenSSL.html).

## Linux

```bash
apt install openssl
```

## macOS

```bash
brew install openssl
```

# Generate RSA key pairs

## 1. Private key

```bash
openssl genrsa -out private.pem
```

The recommended size for RSA keys currently, considering the computational power for brute force attacks, is 2048 bits, default in this command.

## 2. Public key

```bash
openssl rsa -in private.pem -pubout -out public.pem
```

# Used libraries

## JS

- [CryptoJS](https://github.com/brix/crypto-js)
- [JSEncrypt](https://github.com/travist/jsencrypt)

## PHP

- [OpenSSL](https://www.php.net/manual/en/book.openssl.php)

# References

- https://medium.com/b2w-engineering/compartilhando-chaves-aes-utilizando-rsa-com-openssl-3beffb1b2010

- https://searchsecurity.techtarget.com/definition/Advanced-Encryption-Standard

# License

This project is under the MIT license. See the [LICENSE](https://github.com/leovieira/aes-rsa-with-js-php/blob/main/LICENSE) file for more details.

Made with ❤️ by [leovieira.dev](https://leovieira.dev)
