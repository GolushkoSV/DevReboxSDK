<?php

namespace RBX\exceptions;

class InternalServerException extends ApiException
{
    const HTTP_CODE = 500;

    /**
     * @return void
     */
    public function init()
    {
        $this->code = self::HTTP_CODE;
        $this->code_status = 'RBX_internal_server_error';
    }
}
