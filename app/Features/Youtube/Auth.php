<?php

declare(strict_types=1);

namespace App\Features\Youtube;

use App\Features\Api\Support\YoutubeAuthException;
use App\Features\Youtube\Support\AccessToken;
use App\Features\Youtube\Support\AuthException;

class Auth extends Youtube
{
    public function getAuthUrl() : string
    {
        return $this->api->getAuthUrl();
    }

    /**
     * @param array $queryParams
     * @throws \App\Features\Youtube\Support\AuthException
     * @return \App\Features\Youtube\Support\AccessToken
     */
    public function authenticate(array $queryParams) : AccessToken
    {
        try {
            $accessToken = $this->api->getAccessToken($queryParams);
        } catch (YoutubeAuthException $e) {
            throw new AuthException($e);
        }

        return new AccessToken($accessToken->getAccessToken(), $accessToken->getRefreshToken());
    }
}
