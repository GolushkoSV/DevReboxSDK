<?php

namespace RBX\request;

use RBX\response\dto\payment\CryptoAddressDto;
use RBX\response\dto\payment\MethodListDto;
use RBX\response\dto\payment\PaymentDto;

/**
 * Коллекция методов входящих платежей
 */
class PaymentInCollection extends BaseRequest
{
    const
        PATH_PAYMENT_IN_CRYPTO_ADDRESS = 'payment/in/crypto-address',
        PATH_METHOD_LIST = 'payment/in/method-list',
        PATH_PAYMENT_INFO = 'payment/in/payment-info';

    /**
     * Получение крипто адреса
     * @param int $methodId
     * @return CryptoAddressDto
     * @throws \Exception
     */
    public function getCryptoAddress(int $methodId): CryptoAddressDto
    {
        $response = $this->execute(
            self::PATH_PAYMENT_IN_CRYPTO_ADDRESS,
            'GET',
            ['method_id' => $methodId]
        );

        $result = new CryptoAddressDto();
        $result->parseApiResponse($response);

        return $result;
    }

    /**
     * Получение доступных методов платежа
     * @param $currencyId
     * @return MethodListDto
     * @throws \Exception
     */
    public function getMethodList($currencyId): MethodListDto
    {
        $response = $this->execute(
            self::PATH_METHOD_LIST,
            'GET',
            ['currency_id' => $currencyId]
        );

        $result = new MethodListDto();
        $result->parseApiResponse($response);

        return $result;
    }

    /**
     * Получение информации по платежу
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
}
