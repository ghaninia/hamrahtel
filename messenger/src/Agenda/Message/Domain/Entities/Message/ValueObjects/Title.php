<?php

namespace Src\Agenda\Message\Domain\Entities\Message\ValueObjects;

use Src\Shared\Domain\Exceptions\RequiredException;
use Src\Shared\Domain\ValueObject;

class Title extends ValueObject
{

    /**
     * @param string $title
     */
    public function __construct(private string $title)
    {
        $this->isValid();
    }

    /**
     * @return void
     * @throw RequiredException
     */
    private function isValid() {
        if (empty(trim($this->title))) {
            throw new RequiredException();
        }
    }

    public function __toString()
    {
        return $this->title;
    }

    public function jsonSerialize()
    {
        return $this->title;
    }

}
