<?php

namespace RBX\response\dto\client;

use RBX\response\dto\BaseDto;

class WalletRBXDto extends BaseDto
{
    /**
     * ID валюты
     * @var  int $currency_id
     */
    public int $currency_id;

    /**
     * Сумма кошелька
     * @var float $amount
     */
    public float $amount;
}
