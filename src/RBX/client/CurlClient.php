<?php

namespace RBX\client;

use RBX\helpers\RawHeaderParser;
use RBX\response\dto\CurlResponseDto;

/**
 * Класс клиента Curl запросов
 *
 * @package YooKassa
 */
class CurlClient
{
    /** @var array Настройки клиента */
    private $config;


    /** @var int Настройка параметра CURLOPT_TIMEOUT*/
    private $timeout = 80;

    /** @var int Настройка параметра CURLOPT_CONNECTTIMEOUT */
    private $connectionTimeout = 30;

    /** @var array Заголовки по умолчанию */
    private $defaultHeaders = [
        'Content-Type' => 'application/json',
    ];

    /** @var resource Текущий ресурс для работы с curl */
    private $curl;

    /**
     * @inheritdoc
     *
     * @param string $path URL запроса
     * @param string $method HTTP метод
     * @param array $queryParams Массив GET параметров запроса
     * @param string|null $httpBody Тело запроса
     * @param array $headers Массив заголовков запроса
     *
     * @return CurlResponseDto
     * @throws \Exception
     */
    public function call(string $path, string $method, array $queryParams = [], $httpBody = null, array $headers = [])
    {
        $url = $this->prepareUrl($path, $queryParams);

        $this->prepareCurl($method, $httpBody, $this->implodeHeaders($headers), $url);

        list($httpHeaders, $httpBody, $responseInfo) = $this->sendRequest();

        $this->closeCurlConnection();

        return new CurlResponseDto(
            $responseInfo['http_code'],
            $httpHeaders,
            $httpBody,
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
    public function setCurlOption($optionName, $optionValue)
    {
        return curl_setopt($this->curl, $optionName, $optionValue);
    }

    /**
     * @return false|resource
     * @throws \Exception
     */
    private function initCurl()
    {
        if (!extension_loaded('curl')) {
            throw new \Exception();
        }

        if (!$this->curl) {
            $this->curl = curl_init();
        }

        return $this->curl;
    }

    /**
     * Close connection
     */
    public function closeCurlConnection()
    {
        if ($this->curl !== null) {
            curl_close($this->curl);
        }
    }

    /**
     * @return array
     * @throws \Exception
     */
    public function sendRequest()
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

        return array($httpHeaders, $httpBody, $responseInfo);
    }

    /**
     * Устанавливает тело запроса
     *
     * @param string $method HTTP метод
     * @param string $httpBody Тело запроса
     */
    public function setBody($method, $httpBody)
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
    private function handleCurlError($error, $errno)
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
     * @return mixed
     */
    private function getUrl()
    {
        return 'http://api-public.rebox.local';
    }

    /**
     * @param array $headers
     * @return array
     */
    private function implodeHeaders($headers)
    {
        return array_map(function ($key, $value) {
            return $key . ':' . $value;
        }, array_keys($headers), $headers);
    }

    /**
     * @param $url
     * @param array $queryParams
     *
     * @return string
     */
    private function prepareUrl($url, array $queryParams = []): string
    {
        if (!empty($queryParams)) {
            $url = $url . '?' . http_build_query($queryParams);
        }

        return $url;
    }

    /**
     * @param string $method
     * @param string $httpBody
     * @param array $headers
     * @param string $url
     * @throws \Exception
     */
    private function prepareCurl($method, $httpBody, $headers, $url)
    {
        $this->initCurl();

        $this->setCurlOption(CURLOPT_URL, $url);

        $this->setCurlOption(CURLOPT_RETURNTRANSFER, true);

        $this->setCurlOption(CURLOPT_HEADER, true);

        $this->setBody($method, $httpBody);

        $this->setCurlOption(CURLOPT_HTTPHEADER, $headers);

        $this->setCurlOption(CURLOPT_CONNECTTIMEOUT, $this->connectionTimeout);

        $this->setCurlOption(CURLOPT_TIMEOUT, $this->timeout);
    }
}
