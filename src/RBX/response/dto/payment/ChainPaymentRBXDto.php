<?php

namespace RBX\response\dto\payment;

use RBX\response\dto\BaseResponseRBXDto;
use RBX\response\dto\CurlResponseDto;

class ChainPaymentRBXDto extends BaseResponseRBXDto
{
    /** @var PaymentRBXDto[] $_payments */
    protected array $_payments;

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
            $paymentDto->fill(
                $payment['uid'],
                $payment['chain_uid'],
                $payment['status'],
                $payment['currency_id'],
                $payment['amount_payment'],
                $payment['amount'],
                $payment['commission'],
            );

            $this->_payments [] = $payment;
        }
    }
}
