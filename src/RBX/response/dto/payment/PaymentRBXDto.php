<?php

namespace RBX\response\dto\payment;

use RBX\response\dto\BaseResponseRBXDto;
use RBX\response\dto\CurlResponseDto;

class PaymentRBXDto extends BaseResponseRBXDto
{
    /**
     * UID платежа
     * @var string $uid
     */
    protected string $uid;

    /**
     * UID цепочки платежа
     * @var string $chain_uid
     */
    protected string $chain_uid;

    /**
     * Статус платежа
     * @var string $status
     */
    protected string $status;

    /**
     * ID валюты
     * @var int $currency_id
     */
    protected int $currency_id;

    /**
     * Сумма платежа
     * @var float $amount_payment
     */
    protected float $amount_payment;

    /**
     * Конечная сумма с учетом комиссий
     * @var float $amount
     */
    protected float $amount;

    /**
     * Комиссия
     * @var float $commission
     */
    protected float $commission;

    /**
     * @param CurlResponseDto $response
     * @return void
     * @throws \Exception
     */
    public function parseApiResponse(CurlResponseDto $response): void
    {
        $decodedResponse = $this->decodeResponse($response);
        $this->setAttributes($decodedResponse);
    }

    /**
     * @return string
     */
    public function getUid(): string
    {
        return $this->uid;
    }

    /**
     * @return string
     */
    public function getChainUid(): string
    {
        return $this->chain_uid;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @return int
     */
    public function getCurrencyId(): int
    {
        return $this->currency_id;
    }

    /**
     * @return float
     */
    public function getAmountPayment(): float
    {
        return $this->amount_payment;
    }

    /**
     * @return float
     */
    public function getAmount(): float
    {
        return $this->amount;
    }

    /**
     * @return float
     */
    public function getCommission(): float
    {
        return $this->commission;
    }
}
