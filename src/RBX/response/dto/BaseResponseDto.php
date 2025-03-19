<?php

namespace RBX\response\dto;

abstract class BaseResponseDto
{
    /**
     * @param ResponseDto $response
     * @return void
     */
    abstract public function parseApiResponse(ResponseDto $response): void;

    /**
     * @param ResponseDto $response
     * @return mixed
     * @throws \Exception
     */
    public function decodeResponse(ResponseDto $response)
    {
        $decodedResponse = json_decode($response->getBody(), true);
        if ($decodedResponse == null) {
            throw new \Exception('Не удалось распарсить ответ от сервера');
        }

        return $decodedResponse;
    }
}
