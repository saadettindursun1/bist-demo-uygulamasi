<?php

class bistCrypt
{
    //her iki değer'de 16 karakter olmalı

    public function code_encrypt($content): string
    {
        $ciphering = "AES-128-CTR";
        $options = 0;
        return $encryption = openssl_encrypt($content, $ciphering, $_ENV['ENCRYPTION_KEY'], $options, $_ENV['ENCRYPTION_IV']);
    }

    public function decode_encrypt($content): string
    {
        $ciphering = "AES-128-CTR";
        $options = 0;
        return $decryption = openssl_decrypt($content, $ciphering, $_ENV['ENCRYPTION_KEY'], $options, $_ENV['ENCRYPTION_IV']);
    }
}
