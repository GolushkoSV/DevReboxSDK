<?php

namespace RBX\response\dto\payment;

use RBX\response\dto\BaseResponseRBXDto;
use RBX\response\dto\CurlResponseDto;

class PaymentOutRBXDto extends BaseResponseRBXDto
{
    /**
     * UID цепочки платежей
     * @var string $chain_uid
     */
    protected string $chain_uid;

    /**
     * Код статус платежа
     * @var int $code
     */
    protected int $code;

    /**
     * Кол-во платежей
     * @var float $total
     */
    protected float $total;

    /**
     * Список успешно созданных платежей
     * @var array $success
     */
    protected array $payments;

    /**
     * Общая сумма с учетом комиссии
     * @var float $totalAmount
     */
    protected float $totalAmount;

    /**
     * Общая сумма платежа
     * @var float $totalAmountPayment
     */
    protected float $totalAmountPayment;

    /**
     * Общая комиссия
     * @var float $totalCommission
     */
    protected float $totalCommission;

    /**
     * @var string|null $error
     */
    protected ?string $error = null;

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
     * UID цепочки платежей
     * @return string
     */
    public function getChainUid(): string
    {
        return $this->chain_uid;
    }

    /**
     * Код платежа (промежуточный статус платежа)
     * @return int
     */
    public function getCode(): int
    {
        return $this->code;
    }

    /**
     * Общая сумма платежа
     * @return float
     */
    public function getTotal(): float
    {
        return $this->total;
    }

    /**
     * Список успешно созданных платежей
     * @return array
     */
    public function getPaymentList(): array
    {
        return $this->payments;
    }

    /**
     * @return float
     */
    public function getTotalAmount(): float
    {
        return $this->totalAmount;
    }

    /**
     * @return float
     */
    public function getTotalAmountPayment(): float
    {
        return $this->totalAmountPayment;
    }

    /**
     * @return float
     */
    public function getTotalCommission(): float
    {
        return $this->totalCommission;
    }

    /**
     * @return string|null
     */
    public function getError(): ?string
    {
        return $this->error;
    }
}
