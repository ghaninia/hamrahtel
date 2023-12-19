<?php

namespace Src\Auth\Application\DTO;

class LoginDto
{
    public function __construct(
        private readonly string $accessToken,
        private readonly string $tokenType,
        private readonly int    $ttl)
    {
    }

    public function getAccessToken(): string
    {
        return $this->accessToken;
    }

    public function getTokenType(): string
    {
        return $this->tokenType;
    }

    public function getTTL(): string
    {
        return $this->ttl;
    }

}
