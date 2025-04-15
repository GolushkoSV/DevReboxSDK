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
    protected array $success;

    /**
     * @param CurlResponseDto $response
     * @return void
     * @throws \Exception
     */
    public function parseApiResponse(CurlResponseDto $response): void
    {
        $decodedResponse = $this->decodeResponse($response);
        $this->chain_uid = $decodedResponse['chain_uid'];
        $this->code = $decodedResponse['code'];
        $this->total = $decodedResponse['total'];
        $this->success = $decodedResponse['success'];
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
    public function getSuccessPaymentList(): array
    {
        return $this->success;
    }
}
