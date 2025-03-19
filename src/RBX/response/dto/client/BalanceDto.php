<?php

namespace RBX\response\dto\client;

use RBX\response\dto\BaseResponseDto;
use RBX\response\dto\ResponseDto;

class BalanceDto extends BaseResponseDto
{
    protected int $currencyId;
    protected float $amount;

    /**
     * @param ResponseDto $response
     * @return void
     * @throws \Exception
     */
    public function parseApiResponse(ResponseDto $response): void
    {
        $decodedResponse = $this->decodeResponse($response);

        $this->currencyId = $decodedResponse['currency_id'];
        $this->amount = $decodedResponse['amount'];
    }
}
