<?php

namespace RBX\response\dto\payment;

use RBX\response\dto\BaseResponseRBXDto;
use RBX\response\dto\CurlResponseDto;

class ChainPaymentRBXDto extends BaseResponseRBXDto
{
    /** @var PaymentRBXDto[] $_payments */
    protected array $payments;

    /** @var array $total */
    protected array $total;

    /**
     * @param CurlResponseDto $response
     * @return void
     * @throws \Exception
     */
    public function parseApiResponse(CurlResponseDto $response): void
    {
        $decodedResponse = $this->decodeResponse($response);
        $this->total = [
            'amount_payment' => $decodedResponse['total']['amount_payment'],
            'amount' => $decodedResponse['total']['amount'],
            'commission' => $decodedResponse['total']['commission'],
        ];

        foreach ($decodedResponse['payments'] as $payment) {
            $paymentDto = new PaymentRBXDto();
            $paymentDto->setAttributes($payment);
            $this->payments [] = $paymentDto;
        }
    }

    /**
     * @return PaymentRBXDto[]
     */
    public function getPayments(): array
    {
        return $this->payments;
    }

    /**
     * @return array
     */
    public function getTotal(): array
    {
        return $this->total;
    }
}
