<?php

namespace Src\Shared\Domain\Exceptions;

final class IncorrectMobileFormatException extends \DomainException
{
    public function __construct()
    {
        parent::__construct('Must be a valid mobile');
    }
}
