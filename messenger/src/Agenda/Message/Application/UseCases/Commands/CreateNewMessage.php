<?php

namespace Src\Agenda\Message\Application\UseCases\Commands;

use Src\Agenda\Message\Domain\Entities\Message\Message;
use Src\Agenda\Message\Domain\Repositories\MessageRepositoryInterface;

class CreateNewMessage
{
    protected MessageRepositoryInterface $message;

    public function __construct()
    {
        $this->message = app(MessageRepositoryInterface::class);
    }

    /**
     * @param Message $message
     * @return Message
     */
    public function __invoke(Message $message): Message
    {
        return $this->message->create($message->userId, $message->title, $message->content);
    }
}
