<?php

namespace Src\Agenda\User\Application\Mappers;

use Src\Agenda\User\Domain\Entities\User\User;
use Src\Agenda\User\Domain\Entities\User\ValueObjects\Mobile;
use Src\Agenda\User\Infrastructure\EloquentModels\UserEloquentModel;

class UserMapper
{
    public static function fromEloquent(UserEloquentModel $model): User
    {
        return new User(
            $model->getId(),
            new Mobile($model->getMobile()),
        );
    }
}
