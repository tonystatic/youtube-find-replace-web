<?php

declare(strict_types=1);

namespace App\Features\Api\Support;

class AccessToken
{
    protected string $accessToken;

    protected string $refreshToken;

    public function __construct(string $accessToken, string $refreshToken)
    {
        $this->accessToken = $accessToken;
        $this->refreshToken = $refreshToken;
    }

    public function getAccessToken() : string
    {
        return $this->accessToken;
    }

    public function getRefreshToken() : string
    {
        return $this->refreshToken;
    }
}
