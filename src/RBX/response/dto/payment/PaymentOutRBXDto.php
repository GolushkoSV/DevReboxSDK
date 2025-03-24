<?php

namespace RBX\response\dto\payment;

use RBX\response\dto\BaseResponseRBXDto;
use RBX\response\dto\CurlResponseDto;

class PaymentOutRBXDto extends BaseResponseRBXDto
{
    protected string $_uid;
    protected string $_chainUid;
    protected int $_code;
    protected float $_total;
    protected array $_success;

    /**
     * @param CurlResponseDto $response
     * @return void
     * @throws \Exception
     */
    public function parseApiResponse(CurlResponseDto $response): void
    {
        $decodedResponse = $this->decodeResponse($response);
        $this->_chainUid = $decodedResponse['chain_uid'];
        $this->_code = $decodedResponse['code'];
        $this->_total = $decodedResponse['total'];
        $this->_success = $decodedResponse['success'];
    }

    /**
     * UID платежа
     * @return int
     */
    public function getUid(): int
    {
        return $this->_uid;
    }

    /**
     * UID цепочки платежей
     * @return string
     */
    public function getChainUid(): string
    {
        return $this->_chainUid;
    }

    /**
     * Код платежа (промежуточный статус платежа)
     * @return int
     */
    public function getCode(): int
    {
        return $this->_code;
    }

    /**
     * Общая сумма платежа
     * @return float
     */
    public function getTotal(): float
    {
        return $this->_total;
    }

    /**
     * Список успешно созданных платежей
     * @return array
     */
    public function getSuccessPaymentList(): array
    {
        return $this->_success;
    }
}
