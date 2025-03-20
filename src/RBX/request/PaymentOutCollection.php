<?php

namespace RBX\request;

use RBX\response\dto\payment\ChainPaymentDto;
use RBX\response\dto\payment\MethodListDto;
use RBX\response\dto\payment\PaymentOutDto;
use RBX\response\dto\payment\PaymentDto;

class PaymentOutCollection extends BaseRequest
{
    const
        PATH_METHOD_LIST = 'payment/out/method-list',
        PATH_PAYMENT = 'payment/out/payment',
        PATH_PAYMENT_INFO = 'payment/out/payment-info',
        PATH_CHAIN_PAYMENT = 'payment/out/chain-payment';

    /**
     * @param int $currencyId
     * @return MethodListDto
     * @throws \Exception
     */
    public function getMethodList(int $currencyId): MethodListDto
    {
        $response = $this->execute(
            self::PATH_METHOD_LIST,
            'GET',
            ['currencyId' => $currencyId]
        );

        $result = new MethodListDto();
        $result->parseApiResponse($response);

        return $result;
    }

    /**
     * @param int $methodId
     * @param float $amount
     * @param array $params
     * @return PaymentOutDto
     * @throws \Exception
     */
    public function payment(int $methodId, float $amount, array $params): PaymentOutDto
    {
        $response = $this->execute(
            self::PATH_PAYMENT,
            'POST',
            ['methodId' => $methodId],
            [
                'amount_payment' => $amount,
                'payment_fields' => $params
            ]
        );

        $result = new PaymentOutDto();
        $result->parseApiResponse($response);

        return $result;
    }

    /**
     * @param string $uid
     * @return PaymentDto
     * @throws \Exception
     */
    public function getPaymentInfo(string $uid): PaymentDto
    {
        $response = $this->execute(
            self::PATH_PAYMENT_INFO,
            'GET',
            ['uid' => $uid]
        );

        $result = new PaymentDto();
        $result->parseApiResponse($response);

        return $result;
    }

    /**
     * @param string $chainUid
     * @return ChainPaymentDto
     * @throws \Exception
     */
    public function getChainPayment(string $chainUid): ChainPaymentDto
    {
        $response = $this->execute(
            self::PATH_CHAIN_PAYMENT,
            'GET',
            ['chainUid' => $chainUid]
        );

        $result = new ChainPaymentDto();
        $result->parseApiResponse($response);

        return $result;
    }
}
