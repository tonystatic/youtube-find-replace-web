<?php

declare(strict_types=1);

namespace App\Features\Auth;

use App\Features\Youtube\YoutubeAuth;
use App\Features\Youtube\YoutubeAuthException;

class Auth
{
    protected YoutubeAuth $youtubeAuth;

    public function __construct(YoutubeAuth $youtubeAuth)
    {
        $this->youtubeAuth = $youtubeAuth;
    }

    public function getAuthUrl() : string
    {
        return $this->youtubeAuth->getAuthUrl();
    }

    /**
     * @param array $queryParams
     * @throws \App\Features\Auth\AuthException
     */
    public function getAuthUser(array $queryParams) : AuthUser
    {
        try {
            $accessToken = $this->youtubeAuth->getAccessToken($queryParams);
        } catch (YoutubeAuthException $e) {
            throw new AuthException($e);
        }
        $email = $this->youtubeAuth->getEmail($accessToken);

        return new AuthUser($email, '', $accessToken);
    }
}
