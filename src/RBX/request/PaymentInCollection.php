<?php

namespace RBX\request;

use RBX\response\dto\payment\CryptoAddressRBXDto;
use RBX\response\dto\payment\method\MethodListRBXDto;
use RBX\response\dto\payment\PaymentRBXDto;

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
     * @return CryptoAddressRBXDto
     * @throws \Exception
     */
    public function getCryptoAddress(int $methodId): CryptoAddressRBXDto
    {
        $response = $this->execute(
            self::PATH_PAYMENT_IN_CRYPTO_ADDRESS,
            self::METHOD_GET,
            ['methodId' => $methodId]
        );

        $result = new CryptoAddressRBXDto();
        $result->parseApiResponse($response);

        return $result;
    }

    /**
     * Получение доступных методов платежа
     * @param $currencyId
     * @return \RBX\response\dto\payment\method\MethodListRBXDto
     * @throws \Exception
     */
    public function getMethodList($currencyId): MethodListRBXDto
    {
        $response = $this->execute(
            self::PATH_METHOD_LIST,
            self::METHOD_GET,
            ['currencyId' => $currencyId]
        );

        $result = new MethodListRBXDto();
        $result->parseApiResponse($response);

        return $result;
    }

    /**
     * Получение информации по платежу
     * @param string $uid
     * @return PaymentRBXDto
     * @throws \Exception
     */
    public function getPaymentInfo(string $uid): PaymentRBXDto
    {
        $response = $this->execute(
            self::PATH_PAYMENT_INFO,
            self::METHOD_GET,
            ['uid' => $uid]
        );

        $result = new PaymentRBXDto();
        $result->parseApiResponse($response);

        return $result;
    }
}
