<?php

namespace Src\Shared\Infrastructure\Communicator\Exceptions;

class InvalidArgumentException extends \Exception
{
    public function __construct(string $message = "invalid arguments!", int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
