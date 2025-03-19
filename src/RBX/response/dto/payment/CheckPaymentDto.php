<?php

namespace RBX\response\dto\payment;

use RBX\response\dto\BaseResponseDto;
use RBX\response\dto\ResponseDto;

class CheckPaymentDto extends BaseResponseDto
{
    protected string $_statusPayment;

    /**
     * @param ResponseDto $response
     * @return void
     * @throws \Exception
     */
    public function parseApiResponse(ResponseDto $response): void
    {
        $this->_statusPayment = $this->decodeResponse($response);
    }

    /**
     * @return string
     */
    public function getStatusPayment(): string
    {
        return $this->_statusPayment;
    }
}
