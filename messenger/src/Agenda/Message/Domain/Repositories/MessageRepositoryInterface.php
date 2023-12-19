<?php

namespace Src\Agenda\Message\Domain\Repositories;

use Src\Agenda\Message\Domain\Entities\Message\Message;

interface MessageRepositoryInterface
{
    public function create(int $userId, string $title, string $content): Message;
}
