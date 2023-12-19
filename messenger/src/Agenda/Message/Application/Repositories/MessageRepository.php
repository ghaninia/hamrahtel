<?php

namespace Src\Agenda\Message\Application\Repositories;

use Src\Agenda\Message\Application\Mappers\MessageMapper;
use Src\Agenda\Message\Domain\Entities\Message\Message;
use Src\Agenda\Message\Domain\Repositories\MessageRepositoryInterface;
use Src\Agenda\Message\Infrastructure\EloquentModels\MessageEloquentModel;

class MessageRepository implements MessageRepositoryInterface
{
    public function create(int $userId, string $title, string $content): Message
    {
        $message = MessageEloquentModel::query()->create([
            'user_id' => $userId,
            'title' => $title,
            'content' => $content,
        ]);
        return MessageMapper::fromEloquent($message);
    }
}
