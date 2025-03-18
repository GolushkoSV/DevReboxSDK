<?php

namespace RBX\request;

use RBX\client\CurlClient;
use RBX\services\SignService;

class BaseRequest
{
    protected const API_HOST = 'http://api-public.rebox.local';

    protected $serial = 'ca185e41e4fd6cca0249236ade373f138cbd21e845a5c20029ba5e75fc854a9f';

    protected $secretKey = 'LS0tLS1CRUdJTiBQUklWQVRFIEtFWS0tLS0tCk1JSHVBZ0VBTUJBR0J5cUdTTTQ5QWdFR0JTdUJCQUFqQklIV01JSFRBZ0VCQkVJQXYxVGhzbGNvV3lxUlV5cEwKTXF2MGhWUjVxSytUZTkvTzVEeHFCZHRwZTBSZDRGMHBYY0F3R0dqeFpabEdvQjFoUEFJWDhvdG5hNU9MVTBUZQptd3U4QWFpaGdZa0RnWVlBQkFGNi9VUWsyamM5K3A2SVFlRmtDcCtKZm5WNGtMdU1WNytqekZyZ1VpQzd0bUlyCmcvcnJjeGhKTmdFT1hTZndBRzFjOU5SbE1BYzgyZDQyWWUxT0RQc0svd0hWa0YwUDlPVE1PUDgvS05iYjRHOUsKa3ZFNEZNRUZnbCtzUnROZi93cEFJK2gxOC9peU0zRzVoeDFHdUR3Rm5reEk5Q01SbG1hd01hUk54SEJqcEFWMgpWdz09Ci0tLS0tRU5EIFBSSVZBVEUgS0VZLS0tLS0K';


    public function execute($path, $method, array $query = [], array $data = [], array $headers = [])
    {
        $signService = new SignService($this->secretKey);
        $headers = array_merge($headers, [
            'Header-Serial' => $this->serial,
            'Header-Sign' => $signService->generateSign(http_build_query($query), $data)
        ]);

        $curl = new CurlClient();
        $result = $curl->call(
            self::API_HOST . '/'. $path,
            $method,
            $query,
            $data,
            $headers
        );

        return $result;
    }
}
