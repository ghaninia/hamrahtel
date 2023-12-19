<?php

namespace Src\Agenda\User\Domain\Execptions;

final class PasswordsDoNotMatchException extends \DomainException
{
    public function __construct()
    {
        parent::__construct('Passwords do not match');
    }
}
