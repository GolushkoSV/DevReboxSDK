<?php

namespace RBX\response\dto\payment;

use RBX\response\dto\BaseResponseRBXDto;
use RBX\response\dto\CurlResponseDto;

class PaymentFieldsRBXDto extends BaseResponseRBXDto
{
    /** @var PaymentFieldRBXDto[] $list */
    protected array $list = [];

    /**
     * @param CurlResponseDto $response
     * @return void
     * @throws \Exception
     */
    public function parseApiResponse(CurlResponseDto $response): void
    {
        $decodedResponse = $this->decodeResponse($response);
        foreach ($decodedResponse as $attributes) {
            $paymentFieldDto = new PaymentFieldRBXDto();
            $paymentFieldDto->setAttributes($attributes);
            $this->list[] = $paymentFieldDto;
        }
    }

    /**
     * @return array
     */
    public function getList(): array
    {
        return $this->list;
    }
}
