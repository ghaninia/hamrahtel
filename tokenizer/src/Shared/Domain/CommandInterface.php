<?php

namespace Src\Shared\Domain;

use Src\Shared\Domain\Exceptions\UnauthorizedUserException;

interface CommandInterface
{
    /**
     * @throws UnauthorizedUserException
     */
    public function execute();
}
