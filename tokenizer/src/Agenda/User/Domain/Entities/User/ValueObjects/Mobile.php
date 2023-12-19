<?php

namespace Src\Agenda\User\Domain\Entities\User\ValueObjects;

use Src\Shared\Domain\Exceptions\IncorrectMobileFormatException;
use Src\Shared\Domain\ValueObject;

class Mobile extends ValueObject
{

    /**
     * @param string $mobile
     */
    public function __construct(private string $mobile)
    {
        $this->isValid();
    }

    /**
     * @throws IncorrectMobileFormatException
     * @return void
     */
    private function isValid() {
        if (!preg_match('/^09[0-9]{9}$/', $this->mobile)) {
            throw new IncorrectMobileFormatException();
        }
    }

    public function __toString()
    {
        return $this->mobile;
    }

    public function jsonSerialize()
    {
        return $this->mobile;
    }

}
