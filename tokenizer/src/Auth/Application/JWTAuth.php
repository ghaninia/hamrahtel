<?php

namespace Src\Auth\Application;

use Src\Agenda\User\Domain\Entities\User\ValueObjects\Mobile;
use Src\Agenda\User\Domain\Execptions\UserNotFoundException;
use Src\Agenda\User\Infrastructure\EloquentModels\UserEloquentModel;
use Src\Auth\Application\Exceptions\InvalidUserCredentialException;
use Src\Agenda\User\Domain\Entities\User\User;
use Src\Auth\Application\DTO\LoginDto;
use Illuminate\Support\Facades\Auth;
use Src\Auth\Domain\AuthInterface;

class JWTAuth implements AuthInterface
{
    public const TOKEN_TYPE = "bearer";

    /**
     * @param array $credentials
     * @return string
     * @throws InvalidUserCredentialException
     */
    public function login(array $credentials): LoginDto
    {
        if ($token = Auth::attempt($credentials)) {
            $ttl = Auth::factory()->getTTL() * 60;
            return new LoginDto($token, static::TOKEN_TYPE, $ttl);
        }
        throw new InvalidUserCredentialException();
    }

    /**
     * @return void
     */
    public function logout(): void
    {
        Auth::logout();
    }

    /**
     * @return User
     * @throw UserNotFoundException
     */
    public function me(): User
    {
        /** @var UserEloquentModel $user */
        $user = Auth::user();
        if ($user) {
            return new User($user->getId(), new Mobile($user->getMobile()));
        }

        throw new UserNotFoundException();
    }


}

