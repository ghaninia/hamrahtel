<?php

namespace Src\Shared\Domain;

use Src\Shared\Domain\Exceptions\UnauthorizedUserException;

interface QueryInterface
{
    /**
     * @throws UnauthorizedUserException
     */
    public function handle(): mixed;
}
