<?php

namespace RBX\dto;

class ResponseDto
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

    public function __construct($config = null)
    {
        if (isset($config['headers'])) {
            $this->headers = $config['headers'];
        }

        if (isset($config['body'])) {
            $this->body = $config['body'];
        }

        if (isset($config['code'])) {
            $this->code = $config['code'];
        }
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
