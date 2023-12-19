<?php

namespace Src\Auth\Domain;

use Src\Auth\Application\DTO\LoginDto;
use Src\Agenda\User\Domain\Entities\User\User;
use Src\Auth\Application\Exceptions\InvalidUserCredentialException;

interface AuthInterface
{
    /**
     * @param array $credentials
     * @return LoginDto
     * @throws InvalidUserCredentialException
     */
    public function login(array $credentials): LoginDto;
    public function logout(): void;

    /**
     * @return User
     * @throw UserNotFoundException
     */
    public function me(): User;
}
