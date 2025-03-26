<?php

namespace RBX\services;

class SignService
{
    private string $secret_key;


    /**
     * @param string $secretKey
     */
    public function __construct(string $secretKey)
    {
        $this->secret_key = $secretKey;
    }

    /**
     * @param string $queryString
     * @param array $postData
     * @return string
     * @throws \Exception
     */
    public function generateSign(string $queryString = '', array $postData = []): string
    {

        $data = $queryString . json_encode($postData);
        openssl_sign($data, $signature, base64_decode($this->secret_key), OPENSSL_ALGO_SHA512);

        return base64_encode($signature);
    }
}
