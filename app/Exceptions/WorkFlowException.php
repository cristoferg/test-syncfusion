<?php

namespace App\Exceptions;

use RuntimeException;

class WorkFlowException extends RuntimeException
{
    protected $params = [];

    public function __construct($message, $params)
    {
        $this->message = $message;
    }

    public function getParams()
    {
        return $this->params;
    }
}
