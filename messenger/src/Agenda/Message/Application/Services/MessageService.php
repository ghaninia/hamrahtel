<?php

namespace Src\Agenda\Message\Application\Services;


use Src\Agenda\Message\Domain\Entities\Message\Message;
use Src\Agenda\Message\Domain\Services\MessageServiceInterface;
use Src\Agenda\Message\Application\UseCases\Commands\CreateNewMessage;

class MessageService implements MessageServiceInterface
{
    public function create(Message $message): Message
    {
        return (new CreateNewMessage())($message);
    }
}
