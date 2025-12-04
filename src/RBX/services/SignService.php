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
        $preparedPostData = $this->clearDataFromJson($postData);
        $data = $queryString . json_encode($preparedPostData);
        openssl_sign($data, $signature, base64_decode($this->secret_key), OPENSSL_ALGO_SHA512);

        return base64_encode($signature);
    }

    /**
     * @param array $data
     * @return array
     */
    public function clearDataFromJson(array $data): array
    {
        $result = [];
        foreach ($data as $k => $v) {
            if (is_array($v)) {
                $result[$k] = $this->clearDataFromJson($v);
            } else {
                $preparedValue = json_decode($v, true);
                if (json_last_error() !== JSON_ERROR_NONE || is_numeric($preparedValue)) {
                    $result[$k] = $v;
                } else {
                    $result[$k] = $preparedValue;
                }
            }
        }

        return $result;
    }
}
