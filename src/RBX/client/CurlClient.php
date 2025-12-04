<?php

namespace RBX\client;

use RBX\response\dto\CurlResponseDto;
use RBX\helpers\RawHeaderParser;

class CurlClient
{
    private int $timeout = 80;
    private int $connectionTimeout = 30;

    private array $defaultHeaders = [
        'Content-Type' => 'application/json',
    ];

    private $curl;

    /**
     * @param string $path URL запроса
     * @param string $method HTTP метод
     * @param array $queryParams Массив GET параметров запроса
     * @param string|null $httpBody Тело запроса
     * @param array $headers Массив заголовков запроса
     *
     * @return CurlResponseDto
     * @throws \Exception
     */
    public function call(
        string $path,
        string $method,
        array $queryParams = [],
        array $httpBody = [],
        array $headers = []
    ): CurlResponseDto {
        $headers = array_merge($this->defaultHeaders, $headers);

        $url = $this->prepareUrl($path, $queryParams);
        $this->prepareCurl($url, $method, $httpBody, $headers);

        list($httpHeaders, $httpBody, $responseInfo) = $this->sendRequest();
        $this->closeCurlConnection();

        return new CurlResponseDto(
            $responseInfo['http_code'],
            $httpHeaders,
            $httpBody
        );
    }

    /**
     * Устанавливает параметры CURL
     *
     * @param string $optionName Имя параметра
     * @param mixed $optionValue Значение параметра
     *
     * @return bool
     */
    protected function setCurlOption(string $optionName, $optionValue): bool
    {
        return curl_setopt($this->curl, $optionName, $optionValue);
    }

    /**
     * @return void
     * @throws \Exception
     */
    private function initCurl(): void
    {
        if (!extension_loaded('curl')) {
            throw new \Exception('Needed curl extension');
        }

        if (!$this->curl) {
            $this->curl = curl_init();
        }
    }

    /**
     * Close connection
     */
    protected function closeCurlConnection()
    {
        if ($this->curl !== null) {
            curl_close($this->curl);
        }
    }

    /**
     * @return array
     * @throws \Exception
     */
    protected function sendRequest(): array
    {
        $response       = curl_exec($this->curl);
        $httpHeaderSize = curl_getinfo($this->curl, CURLINFO_HEADER_SIZE);
        $httpHeaders    = RawHeaderParser::parse(substr($response, 0, $httpHeaderSize));
        $httpBody       = substr($response, $httpHeaderSize);
        $responseInfo   = curl_getinfo($this->curl);
        $curlError      = curl_error($this->curl);
        $curlErrno      = curl_errno($this->curl);
        if ($response === false) {
            $this->handleCurlError($curlError, $curlErrno);
        }

        return [$httpHeaders, $httpBody, $responseInfo];
    }

    /**
     * Устанавливает тело запроса
     *
     * @param string $method HTTP метод
     * @param string $httpBody Тело запроса
     */
    protected function setBody(string $method, string $httpBody)
    {
        $this->setCurlOption(CURLOPT_CUSTOMREQUEST, $method);
        if(!empty($httpBody)) {
            $this->setCurlOption(CURLOPT_POSTFIELDS, $httpBody);
        }
    }

    /**
     * @param string $error
     * @param int $errno
     *
     * @throws \Exception
     */
    private function handleCurlError(string $error, int $errno)
    {
        switch ($errno) {
            case CURLE_COULDNT_CONNECT:
            case CURLE_COULDNT_RESOLVE_HOST:
            case CURLE_OPERATION_TIMEOUTED:
                $msg = 'Could not connect to Rebox API. Please check your internet connection and try again.';
                break;
            case CURLE_SSL_CACERT:
            case CURLE_SSL_PEER_CERTIFICATE:
                $msg = 'Could not verify SSL certificate.';
                break;
            default:
                $msg = 'Unexpected error communicating.';
        }

        $msg .= "\n\n(Network error [errno $errno]: $error)";
        throw new \Exception($msg);
    }

    /**
     * @param array $headers
     * @return array
     */
    private function implodeHeaders(array $headers): array
    {
        return array_map(function ($key, $value) {
            return $key . ':' . $value;
        }, array_keys($headers), $headers);
    }

    /**
     * @param string $url
     * @param array $queryParams
     *
     * @return string
     */
    private function prepareUrl(string $url, array $queryParams = []): string
    {
        if (!empty($queryParams)) {
            $url = $url . '?' . http_build_query($queryParams);
        }

        return $url;
    }

    /**
     * @param string $url
     * @param string $method
     * @param array $httpBody
     * @param array $headers
     * @throws \Exception
     */
    private function prepareCurl(string $url, string $method, array $httpBody = [], array $headers = [])
    {
        $this->initCurl();

        $this->setCurlOption(CURLOPT_URL, $url);

        $this->setCurlOption(CURLOPT_RETURNTRANSFER, true);

        $this->setCurlOption(CURLOPT_HEADER, true);

        if ($headers['Content-Type'] == 'multipart/form-data') {
            $this->setCurlOption(CURLOPT_POSTFIELDS, $httpBody);
        } else {
            $this->setBody($method, json_encode($httpBody));
        }

        $headers = $this->implodeHeaders($headers);
        $this->setCurlOption(CURLOPT_HTTPHEADER, $headers);

        $this->setCurlOption(CURLOPT_CONNECTTIMEOUT, $this->connectionTimeout);

        $this->setCurlOption(CURLOPT_TIMEOUT, $this->timeout);
    }
}
