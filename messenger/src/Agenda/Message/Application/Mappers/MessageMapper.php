<?php

namespace Src\Agenda\Message\Application\Mappers;

use Src\Agenda\Message\Domain\Entities\Message\Message;
use Src\Agenda\Message\Domain\Entities\Message\ValueObjects\Title;
use Src\Agenda\Message\Infrastructure\EloquentModels\MessageEloquentModel;

class MessageMapper
{
    public static function fromEloquent(MessageEloquentModel $model): Message
    {
        return new Message(
            $model->getId(),
            new Title($model->getTitle()),
            $model->getContent(),
            $model->getUserId(),
        );
    }

    public static function fromRequest(int $userId, string $title, string $content): Message
    {
        return new Message(
            null,
            new Title($title),
            $content,
            $userId
        );
    }
}
