<?php

namespace RBX\exceptions;

class ValidationException extends ApiException
{
    const HTTP_CODE = 460;

    /**
     * @return void
     */
    public function init()
    {
        $this->code = self::HTTP_CODE;
        $this->code_status = 'RBX_validation_error';
    }
}
