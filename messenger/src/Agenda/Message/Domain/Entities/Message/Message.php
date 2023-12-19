<?php

namespace Src\Agenda\Message\Domain\Entities\Message;

use Src\Agenda\Message\Domain\Entities\Message\ValueObjects\Title;
use Src\Shared\Domain\AggregateRoot;

class Message extends AggregateRoot
{
    public function __construct(
        public readonly ?int $id,
        public readonly Title $title,
        public readonly string $content,
        public readonly int $userId
    ) {}

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'content' => $this->content,
            'user_id' => $this->userId,
        ];
    }

}
