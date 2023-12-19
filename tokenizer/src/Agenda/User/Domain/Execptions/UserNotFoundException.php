<?php

namespace Src\Agenda\User\Domain\Execptions;

class UserNotFoundException extends \DomainException
{
    public function __construct()
    {
        parent::__construct('user not found!');
    }
}
