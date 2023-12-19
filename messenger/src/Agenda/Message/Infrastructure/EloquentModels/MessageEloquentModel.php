<?php

namespace Src\Agenda\Message\Infrastructure\EloquentModels;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Src\Agenda\Message\Domain\Factories\MessageEloquentModelFactory;

class MessageEloquentModel extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = "messages";

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'title',
        'content',
    ];

    /**
     * @return MessageEloquentModelFactory
     */
    protected static function newFactory()
    {
        return new MessageEloquentModelFactory();
    }

    /** @return integer */
    public function getId()
    {
        return $this->id;
    }

    /** @return string */
    public function getTitle()
    {
        return $this->title;
    }

    /** @return string */
    public function getContent()
    {
        return $this->content;
    }

    /** @return int */
    public function getUserId()
    {
        return $this->user_id;
    }

    /** @return \DateTime */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

}
