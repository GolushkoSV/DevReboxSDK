<?php

namespace RBX\response\dto\payment;

use RBX\response\dto\BaseResponseDto;
use RBX\response\dto\ResponseDto;

class ChainPaymentDto extends BaseResponseDto
{
    /** @var PaymentDto[] $_payments */
    protected array $_payments;

    /** @var array $total */
    protected array $total;

    /**
     * @param ResponseDto $response
     * @return void
     * @throws \Exception
     */
    public function parseApiResponse(ResponseDto $response): void
    {
        $decodedResponse = $this->decodeResponse($response);
        $this->total = [
            'amount_payment' => $decodedResponse['total']['amount_payment'],
            'amount' => $decodedResponse['total']['amount'],
            'commission' => $decodedResponse['total']['commission'],
        ];

        foreach ($decodedResponse['payments'] as $payment) {
            $paymentDto = new PaymentDto();
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
