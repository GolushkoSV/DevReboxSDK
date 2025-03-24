<?php

namespace RBX\exceptions;

class SignAuthException extends ApiException
{
    const HTTP_CODE = 401;

    /**
     * @return void
     */
    public function init()
    {
        $this->code = self::HTTP_CODE;
        $this->code_status = 'RBX_sign_auth_error';
    }
}
