<?php

declare(strict_types=1);

namespace App\Features\Api\Support;

class Tokens
{
    protected string $accessToken;

    protected string $refreshToken;

    protected int $tokenCreatedAt;

    protected int $tokenExpiresIn;

    protected bool $refreshed;

    public function __construct(string $accessToken, string $refreshToken, int $tokenCreatedAt, int $tokenExpiresIn)
    {
        $this->accessToken = $accessToken;
        $this->refreshToken = $refreshToken;
        $this->tokenCreatedAt = $tokenCreatedAt;
        $this->tokenExpiresIn = $tokenExpiresIn;

        $this->refreshed = false;
    }

    public function getAccessToken() : string
    {
        return $this->accessToken;
    }

    public function getRefreshToken() : string
    {
        return $this->refreshToken;
    }

    public function getTokenCreatedAt() : int
    {
        return $this->tokenCreatedAt;
    }

    public function getTokenExpiresIn() : int
    {
        return $this->tokenExpiresIn;
    }

    public function wereRefreshed() : bool
    {
        return $this->refreshed;
    }

    public function setAccessToken(string $accessToken) : self
    {
        $this->accessToken = $accessToken;

        return $this;
    }

    public function setRefreshToken(string $refreshToken) : self
    {
        $this->refreshToken = $refreshToken;

        return $this;
    }

    public function setTokenCreatedAt(int $tokenCreatedAt) : self
    {
        $this->tokenCreatedAt = $tokenCreatedAt;

        return $this;
    }

    public function setTokenExpiresIn(int $tokenExpiresIn) : self
    {
        $this->tokenExpiresIn = $tokenExpiresIn;

        return $this;
    }

    public function setRefreshed(bool $value = true) : self
    {
        $this->refreshed = $value;

        return $this;
    }
}
