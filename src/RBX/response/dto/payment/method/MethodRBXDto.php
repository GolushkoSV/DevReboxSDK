<?php

namespace RBX\response\dto\payment\method;

use RBX\response\dto\BaseDto;

class MethodRBXDto extends BaseDto
{
    /**
     * ID метода платежа
     * @var int $id
     */
    public int $id;

    /**
     * Код метода платежа
     * @var string $code
     */
    public string $code;

    /**
     * Название метода платежа
     * @var string $name
     */
    public string $name;

    /**
     * Описание метода платежа
     * @var string $description
     */
    public string $description;

    /**
     * ID валюты
     * @var int $currency_id
     */
    public int $currency_id;

    /**
     * Минимальный размер платежа
     * @var float $min_amount
     */
    public float $min_amount;

    /**
     * Лимит платежа
     * @var float $max_amount
     */
    public float $max_amount;
}
