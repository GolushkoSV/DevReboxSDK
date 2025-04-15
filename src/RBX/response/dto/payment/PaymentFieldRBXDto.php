<?php

namespace RBX\response\dto\payment;

use RBX\response\dto\BaseDto;

class PaymentFieldRBXDto extends BaseDto
{
    /**
     * @var string $code
     */
    public string $code;

    /**
     * @var string $title
     */
    public string $title;

    /**
     * @var string $label
     */
    public string $label;

    /**
     * @var string $mask
     */
    public string $mask;

    /**
     * @var string $regexp
     */
    public string $regexp;

    /**
     * @var int $minLen
     */
    public int $minLen;

    /**
     * @var int $maxLen
     */
    public int $maxLen;
}
