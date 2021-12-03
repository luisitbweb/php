<?php

$algorithm = MCRYPT_BLOWFISH;
$key = 'That golden key that opens the palace of eternity.';
$data = 'The chicken escapes at dawn. Send help with Mr. Blue.';
$mode = MCRYPT_MODE_CBC;

$iv = mcrypt_create_iv(mcrypt_get_iv_size($algorithm, $mode), MCRYPT_DEV_URANDOM);

$encrypted_data = mcrypt_encrypt($algorithm, $key, $data, $mode, $iv);
$plain_text = base64_encode($encrypted_data);
echo $plain_text . "\n";

$encrypted_data = base64_decode($plain_text);
$decoded = mcrypt_decrypt($algorithm, $key, $encrypted_data, $mode, $iv);
// trim() will remove any trailing NULL bytes that mcrypt_decrypt() may
// have added to pad the output to be a whole number of 8-byte blocks
echo trim($decoded) . "\n";

/*
 Table 18-1. mcrypt mode constants
Mode constant Description
MCRYPT_MODE_ECB Electronic Code Book mode
MCRYPT_MODE_CBC Cipher Block Chaining mode
MCRYPT_MODE_CFB Cipher Feedback mode
MCRYPT_MODE_OFB Output Feedback mode with 8 bits of feedback
MCRYPT_MODE_NOFB Output Feedback mode with n bits of feedback, where n is the block size of the algorithm used
MCRYPT_MODE_STREAM Stream Cipher mode, for algorithms such as RC4 and WAKE
 */