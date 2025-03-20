<?php

namespace RBX\response\dto\payment;

use RBX\response\dto\BaseResponseDto;
use RBX\response\dto\ResponseDto;

class CryptoAddressDto extends BaseResponseDto
{
    protected string $crypto_address;

    /**
     * @param ResponseDto $response
     * @return void
     * @throws \Exception
     */
    public function parseApiResponse(ResponseDto $response): void
    {
        $this->crypto_address = $this->decodeResponse($response);
    }
}
