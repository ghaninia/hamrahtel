<?php

namespace Src\Shared\Infrastructure\Communicator\DTO;

class UserInformationDTO
{
    /**
     * @param int $userId
     * @param string $mobile
     */
    public function __construct(private readonly int $userId, private readonly string $mobile)
    {
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->userId;
    }

    /**
     * @return string
     */
    public function getMobile(): string
    {
        return $this->mobile;
    }
}
