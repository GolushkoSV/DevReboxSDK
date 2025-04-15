<?php

namespace RBX\request;

use RBX\response\dto\CurlResponseDto;
use RBX\services\SignService;
use RBX\client\CurlClient;

class BaseRequest
{
    const
        METHOD_GET = 'GET',
        METHOD_POST = 'POST';

    protected string $host;

    private string $serial;

    private string $secretKey;

    /**
     * @param string $host
     * @param string $serial
     * @param string $secretKey
     */
    public function __construct(string $host, string $serial, string $secretKey)
    {
        $this->host = $host;
        $this->serial = $serial;
        $this->secretKey = $secretKey;
    }

    /**
     * @param string $path
     * @param string $method
     * @param array $query
     * @param array $data
     * @param array $headers
     * @return CurlResponseDto
     * @throws \Exception
     */
    protected function execute(
        string $path,
        string $method,
        array $query = [],
        array $data = [],
        array $headers = []
    ): CurlResponseDto {
        $signService = new SignService($this->secretKey);
        $headers = array_merge($headers, [
            'Header-Serial' => $this->serial,
            'Header-Sign' => $signService->generateSign(http_build_query($query), $data)
        ]);

        $curl = new CurlClient();

        return $curl->call($this->host .'/'. $path, $method, $query, json_encode($data), $headers);
    }
}
