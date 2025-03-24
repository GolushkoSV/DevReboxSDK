<?php

namespace RBX\response\dto\payment;

use RBX\response\dto\BaseResponseRBXDto;
use RBX\response\dto\CurlResponseDto;

class CryptoAddressRBXDto extends BaseResponseRBXDto
{
    protected string $crypto_address;

    /**
     * @param CurlResponseDto $response
     * @return void
     * @throws \Exception
     */
    public function parseApiResponse(CurlResponseDto $response): void
    {
        $this->crypto_address = $this->decodeResponse($response);
    }
}
