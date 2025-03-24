<?php

namespace RBX\exceptions;

class ForbiddenException extends ApiException
{
    const HTTP_CODE = 403;

    /**
     * @return void
     */
    public function init()
    {
        $this->code = self::HTTP_CODE;
        $this->code_status = 'RBX_forbidden_error';
    }
}
