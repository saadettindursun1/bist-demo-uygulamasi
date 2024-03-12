<?php
class bistCrypt
{
    //her iki değer'de 16 karakter olmalı
    public $encryption_iv = 'kD]iRt_w2!v9r1j(';
    public $encryption_key = "^13}Y8jNlbmN:bMX";

    public function code_encrypt($content): string
    {
        $ciphering = "AES-128-CTR";
        $options = 0;
        return $encryption = openssl_encrypt($content, $ciphering, $this->encryption_key, $options, $this->encryption_iv);
    }

    public function decode_encrypt($content): string
    {
        $ciphering = "AES-128-CTR";
        $options = 0;
        return $decryption = openssl_decrypt($content, $ciphering, $this->encryption_key, $options, $this->encryption_iv);
    }
}
