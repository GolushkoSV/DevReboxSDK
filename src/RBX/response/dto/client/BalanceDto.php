<?php

namespace RBX\response\dto\client;

use RBX\response\dto\BaseResponseDto;
use RBX\response\dto\ResponseDto;

class BalanceDto extends BaseResponseDto
{
    protected float $balance = 0;

    /**
     * @param ResponseDto $response
     * @return void
     * @throws \Exception
     */
    public function parseApiResponse(ResponseDto $response): void
    {
        $this->balance = $this->decodeResponse($response);
    }

    public function getBalance(): float
    {
        return $this->balance;
    }
}
