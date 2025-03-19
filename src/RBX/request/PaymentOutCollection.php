<?php

namespace RBX\request;

use RBX\response\dto\payment\CheckPaymentDto;
use RBX\response\dto\payment\MethodListDto;

class PaymentOutCollection extends BaseRequest
{
    const
        PATH_METHOD_LIST = 'payment/out/method-list',
        PATH_PAYMENT = 'payment/out/payment',
        PATH_CHECK = 'payment/out/check',
        PATH_CHECK_CHAIN = 'payment/out/check-chain';

    /**
     * @param int $currencyId
     * @return MethodListDto
     * @throws \Exception
     */
    public function getMethodList(int $currencyId): MethodListDto
    {
        $response = $this->execute(self::PATH_METHOD_LIST, 'GET', ['currencyId' => $currencyId]);
        $result = new MethodListDto();
        $result->parseApiResponse($response);

        return $result;
    }

    /**
     * @return void
     * @throws \Exception
     */
    public function payment(int $methodId, float $amount, $params): CheckPaymentDto
    {
        $response = $this->execute(
            self::PATH_PAYMENT,
            'POST',
            ['methodId' => $methodId],
            [
                'amount' => $amount,
                'payment_fields' => $params
            ]
        );

        $result = new CheckPaymentDto();
        $result->parseApiResponse($response);

        return $result;
    }

    /**
     * todo Нужно переделать в публичном апи. Должен быть один метод? должен?
     * @return void
     * @throws \Exception
     */
    public function check(string $uid): CheckPaymentDto
    {
        $response = $this->execute(self::PATH_CHECK, 'POST', ['uid' => $uid]);
        $result = new CheckPaymentDto();
        $result->parseApiResponse($response);

        return $result;
    }
}
