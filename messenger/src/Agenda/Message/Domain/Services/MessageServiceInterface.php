<?php

namespace Src\Agenda\Message\Domain\Services;

use Src\Agenda\Message\Domain\Entities\Message\Message;

interface MessageServiceInterface
{
    public function create(Message $message): Message;
}
