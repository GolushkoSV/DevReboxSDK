<?php

namespace RBX\response\dto\payment;

use RBX\response\dto\BaseResponseRBXDto;
use RBX\response\dto\CurlResponseDto;

class PaymentRBXDto extends BaseResponseRBXDto
{
    protected string $_uid;

    protected string $_chain_uid;

    protected string $_status;

    protected int $_currency_id;

    protected float $_amount_payment;

    protected float $_amount;

    protected float $_commission;

    /**
     * @param CurlResponseDto $response
     * @return void
     * @throws \Exception
     */
    public function parseApiResponse(CurlResponseDto $response): void
    {
        $decodedResponse = $this->decodeResponse($response);
        $this->_uid = $decodedResponse['uid'];
        $this->_chain_uid = $decodedResponse['chain_uid'];
        $this->_status = $decodedResponse['status'];
        $this->_currency_id = $decodedResponse['currency_id'];
        $this->_amount_payment = $decodedResponse['amount_payment'];
        $this->_amount = $decodedResponse['amount'];
        $this->_commission = $decodedResponse['commission'];
    }

    /**
     * @param string $uid
     * @param string $chain_uid
     * @param string $status
     * @param int $currency_id
     * @param float $amount_payment
     * @param float $amount
     * @param float $commission
     * @return void
     */
    public function fill(
        string $uid,
        string $chain_uid,
        string $status,
        int $currency_id,
        float $amount_payment,
        float $amount,
        float $commission
    ): void {
        $this->_uid = $uid;
        $this->_chain_uid = $chain_uid;
        $this->_status = $status;
        $this->_currency_id = $currency_id;
        $this->_amount_payment = $amount_payment;
        $this->_amount = $amount;
        $this->_commission = $commission;
    }

    /**
     * @return string
     */
    public function getUid(): string
    {
        return $this->_uid;
    }

    /**
     * @return string
     */
    public function getChainUid(): string
    {
        return $this->_chain_uid;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->_status;
    }

    /**
     * @return int
     */
    public function getCurrencyId(): int
    {
        return $this->_currency_id;
    }

    /**
     * @return float
     */
    public function getAmountPayment(): float
    {
        return $this->_amount_payment;
    }

    /**
     * @return float
     */
    public function getAmount(): float
    {
        return $this->_amount;
    }

    /**
     * @return float
     */
    public function getCommission(): float
    {
        return $this->_commission;
    }
}
