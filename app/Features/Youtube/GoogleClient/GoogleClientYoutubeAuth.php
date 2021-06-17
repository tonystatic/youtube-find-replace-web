<?php

declare(strict_types=1);

namespace App\Features\Youtube\GoogleClient;

use App\Features\Youtube\YoutubeAuth;
use App\Features\Youtube\YoutubeAuthException;
use Google_Service_Oauth2;

class GoogleClientYoutubeAuth extends GoogleClient implements YoutubeAuth
{
    public function getAuthUrl() : string
    {
        return $this->client->createAuthUrl();
    }

    public function getAccessToken(array $queryParams) : string
    {
        if (! isset($queryParams['code'])) {
            throw new YoutubeAuthException();
        }
        $this->client->fetchAccessTokenWithAuthCode($queryParams['code']);
        $accessTokenArray = $this->client->getAccessToken();
        if (! isset($accessTokenArray['access_token'])) {
            throw new YoutubeAuthException();
        }

        return $accessTokenArray['access_token'];
    }

    public function getEmail(string $accessToken) : string
    {
        $this->client->setAccessToken($accessToken);
        $oauthService = new Google_Service_Oauth2($this->client);
        $tokenInfo = $oauthService->tokeninfo();

        return $tokenInfo->getEmail();
    }
}
