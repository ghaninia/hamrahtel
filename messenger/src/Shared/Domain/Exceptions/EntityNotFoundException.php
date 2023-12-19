<?php

namespace Src\Shared\Domain\Exceptions;

class EntityNotFoundException extends \DomainException
{
    public function __construct(string $message = 'Entity not found')
    {
        parent::__construct($message);
    }
}
