<?php

namespace Src\Shared\Infrastructure\Communicator\Exceptions;

class UnAuthorizedException extends \Exception
{
    public function __construct(string $message = "Unauthenticated.", int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
