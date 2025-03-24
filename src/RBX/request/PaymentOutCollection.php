<?php

namespace RBX\request;

use RBX\response\dto\payment\ChainPaymentRBXDto;
use RBX\response\dto\payment\MethodListRBXDto;
use RBX\response\dto\payment\PaymentOutRBXDto;
use RBX\response\dto\payment\PaymentRBXDto;

class PaymentOutCollection extends BaseRequest
{
    const
        PATH_METHOD_LIST = 'payment/out/method-list',
        PATH_PAYMENT = 'payment/out/payment',
        PATH_PAYMENT_INFO = 'payment/out/payment-info',
        PATH_CHAIN_PAYMENT = 'payment/out/chain-payment';

    /**
     * @param int $currencyId
     * @return MethodListRBXDto
     * @throws \Exception
     */
    public function getMethodList(int $currencyId): MethodListRBXDto
    {
        $response = $this->execute(
            self::PATH_METHOD_LIST,
            'GET',
            ['currencyId' => $currencyId]
        );

        $result = new MethodListRBXDto();
        $result->parseApiResponse($response);

        return $result;
    }

    /**
     * @param int $methodId
     * @param float $amount
     * @param array $params
     * @return PaymentOutRBXDto
     * @throws \Exception
     */
    public function payment(int $methodId, float $amount, array $params): PaymentOutRBXDto
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

        $result = new PaymentOutRBXDto();
        $result->parseApiResponse($response);

        return $result;
    }

    /**
     * @param string $uid
     * @return PaymentRBXDto
     * @throws \Exception
     */
    public function getPaymentInfo(string $uid): PaymentRBXDto
    {
        $response = $this->execute(
            self::PATH_PAYMENT_INFO,
            'GET',
            ['uid' => $uid]
        );

        $result = new PaymentRBXDto();
        $result->parseApiResponse($response);

        return $result;
    }

    /**
     * @param string $chainUid
     * @return ChainPaymentRBXDto
     * @throws \Exception
     */
    public function getChainPayment(string $chainUid): ChainPaymentRBXDto
    {
        $response = $this->execute(
            self::PATH_CHAIN_PAYMENT,
            'GET',
            ['chainUid' => $chainUid]
        );

        $result = new ChainPaymentRBXDto();
        $result->parseApiResponse($response);

        return $result;
    }
}
