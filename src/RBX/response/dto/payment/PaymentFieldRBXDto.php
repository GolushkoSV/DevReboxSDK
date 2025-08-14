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
     * @var string|null
     */
    public ?string $label;

    /**
     * @var string|null
     */
    public ?string $mask;

    /**
     * @var string|null
     */
    public ?string $regexp;

    /**
     * @var int|null
     */
    public ?int $minLen;

    /**
     * @var int|null
     */
    public ?int $maxLen;
}
