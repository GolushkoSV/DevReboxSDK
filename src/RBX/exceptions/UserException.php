<?php

namespace RBX\exceptions;

class UserException extends ApiException
{
    const HTTP_CODE = 400;

    /**
     * @return void
     */
    public function init()
    {
        $this->code = self::HTTP_CODE;
        $this->code_status = 'RBX_general_error';
    }
}
