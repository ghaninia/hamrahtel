<?php

namespace Src\Agenda\User\Domain\Entities\User;

use Src\Agenda\User\Domain\Entities\User\ValueObjects\FirstName;
use Src\Agenda\User\Domain\Entities\User\ValueObjects\Gender;
use Src\Agenda\User\Domain\Entities\User\ValueObjects\LastName;
use Src\Agenda\User\Domain\Entities\User\ValueObjects\Mobile;
use Src\Shared\Domain\AggregateRoot;

class User extends AggregateRoot
{
    public function __construct(
        public readonly ?int $id,
        public readonly Mobile $mobile
    ) {}

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'mobile' => $this->mobile,
        ];
    }

}
