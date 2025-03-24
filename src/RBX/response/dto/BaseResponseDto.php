<?php

namespace RBX\response\dto;

use RBX\exceptions\InternalServerException;
use RBX\exceptions\NotFoundException;
use RBX\exceptions\SignAuthException;
use RBX\exceptions\UserException;
use RBX\exceptions\ValidationException;

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

        if (isset($decodedResponse['result'])) {
            return $decodedResponse['result'];
        }

        if (isset($decodedResponse['code'])) {
            switch ($decodedResponse['code']) {
                case UserException::HTTP_CODE:
                    throw new UserException(
                        $decodedResponse['message'],
                        $decodedResponse['error_data'] ?? []
                    );
                case SignAuthException::HTTP_CODE:
                    throw new SignAuthException(
                        $decodedResponse['message'],
                        $decodedResponse['error_data'] ?? []
                    );
                case NotFoundException::HTTP_CODE:
                    throw new NotFoundException(
                        $decodedResponse['message'],
                        $decodedResponse['error_data'] ?? []
                    );
                case ValidationException::HTTP_CODE:
                    throw new ValidationException(
                        $decodedResponse['message'],
                        $decodedResponse['error_data'] ?? []
                    );
                default:
                    throw new InternalServerException(
                        $decodedResponse['message'],
                        $decodedResponse['error_data'] ?? []
                    );
            }
        }

        throw new \Exception('Ошибка формата ответа от сервера');
    }
}
