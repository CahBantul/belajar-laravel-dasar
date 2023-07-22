<?php

namespace App\Exceptions;

class ValidationException extends \Exception
{
    public function __contruct(string $message)
    {
        parent::__construct($message);
    }
}
