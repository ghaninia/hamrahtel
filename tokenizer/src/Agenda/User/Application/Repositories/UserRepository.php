<?php

namespace Src\Agenda\User\Application\Repositories;

use Src\Agenda\User\Application\Mappers\UserMapper;
use Src\Agenda\User\Domain\Entities\User\User;
use Src\Agenda\User\Domain\Execptions\UserNotFoundException;
use Src\Agenda\User\Domain\Repositories\UserRepositoryInterface;
use Src\Agenda\User\Infrastructure\EloquentModels\UserEloquentModel;

class UserRepository implements UserRepositoryInterface
{
    public function credentialByMobile(string $mobile, string $password): User
    {
        $user = UserEloquentModel::query()
            ->where("mobile", $mobile)
            ->where("passwor", bcrypt($password))
            ->first();
        !is_null($user)?: throw new UserNotFoundException();
        return UserMapper::fromEloquent($user);
    }
}
