<?php

namespace Src\Auth\Application\Exceptions;

class InvalidUserCredentialException extends \Exception
{
    public function __construct()
    {
        parent::__construct('Invalid user credentials');
    }
}
