<?php

namespace RBX\exceptions;

abstract class ApiException extends \Exception
{
    public string $code_status;

    public array $error_data;

    /**
     * @param string $message
     * @param array $error_data
     */
    public function __construct(string $message, array $error_data = [])
    {
        $this->message = $message;
        $this->error_data = $error_data;

        parent::__construct($message, $this->code);
    }

    abstract public function init();
}
