<?php

namespace Src\Agenda\User\Domain\Repositories;

use Src\Agenda\User\Domain\Entities\User\User;

interface UserRepositoryInterface
{

    public function credentialByMobile(string $mobile, string $password): User;
}
