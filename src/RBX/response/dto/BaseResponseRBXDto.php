<?php

namespace RBX\response\dto;

use RBX\exceptions\InternalServerException;
use RBX\exceptions\ValidationException;
use RBX\exceptions\NotFoundException;
use RBX\exceptions\SignAuthException;
use RBX\exceptions\UserException;

abstract class BaseResponseRBXDto extends BaseDto
{
    /**
     * @param CurlResponseDto $response
     * @return void
     */
    abstract public function parseApiResponse(CurlResponseDto $response): void;

    /**
     * @param CurlResponseDto $response
     * @return mixed
     * @throws \Exception
     */
    public function decodeResponse(CurlResponseDto $response)
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
