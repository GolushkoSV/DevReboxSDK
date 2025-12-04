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
     * @param string $urlPath
     * @param array $queryParams
     * @return string
     */
    public function generateSign(string $urlPath, array $queryParams = []): string
    {
        $data = $urlPath;
        if (!empty($queryParams)) {
            $data .= '?' . http_build_query($queryParams);
        }

        openssl_sign($data, $signature, base64_decode($this->secret_key), OPENSSL_ALGO_SHA512);

        return base64_encode($signature);
    }
}
