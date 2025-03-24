<?php

namespace RBX\exceptions;

class NotFoundException extends ApiException
{
    const HTTP_CODE = 404;

    /**
     * @return void
     */
    public function init()
    {
        $this->code = self::HTTP_CODE;
        $this->code_status = 'RBX_not_found';
    }
}
