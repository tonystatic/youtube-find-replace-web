<?php

declare(strict_types=1);

namespace App\Features\Auth;

class AuthUser
{
    protected string $email;

    protected string $title;

    protected string $accessToken;

    public function __construct(string $email, string $title, string $accessToken)
    {
        $this->email = $email;
        $this->title = $title;
        $this->accessToken = $accessToken;
    }

    public function getEmail() : string
    {
        return $this->email;
    }

    public function getTitle() : string
    {
        return $this->title;
    }

    public function getAccessToken() : string
    {
        return $this->accessToken;
    }
}
