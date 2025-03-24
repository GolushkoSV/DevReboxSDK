<?php

namespace RBX\response\dto\client;

use RBX\response\dto\BaseResponseRBXDto;
use RBX\response\dto\CurlResponseDto;

class BalanceRBXDto extends BaseResponseRBXDto
{
    protected float $balance = 0;

    /**
     * @param CurlResponseDto $response
     * @return void
     * @throws \Exception
     */
    public function parseApiResponse(CurlResponseDto $response): void
    {
        $this->balance = $this->decodeResponse($response);
    }

    public function getBalance(): float
    {
        return $this->balance;
    }
}
