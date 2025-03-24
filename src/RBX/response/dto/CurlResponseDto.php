<?php

namespace RBX\response\dto;

class CurlResponseDto
{
    /**
     * HTTP код ответа
     * @var int|string
     */
    protected $code;

    /**
     * Массив заголовков ответа
     * @var array
     */
    protected $headers;

    /**
     * Тело ответа
     * @var mixed
     */
    protected $body;

    /**
     * @param $code
     * @param $headers
     * @param $body
     */
    public function __construct($code, $headers, $body)
    {
        $this->code     = $code;
        $this->headers  = $headers;
        $this->body     = $body;
    }

    /**
     * Возвращает массив заголовков ответа
     *
     * @return array Массив заголовков ответа
     */
    public function getHeaders()
    {
        return $this->headers;
    }

    /**
     * Возвращает тело ответа
     *
     * @return mixed Тело ответа
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * Возвращает HTTP код ответа
     *
     * @return int|string HTTP код ответа
     */
    public function getCode()
    {
        return $this->code;
    }
}
