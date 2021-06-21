<?php

declare(strict_types=1);

namespace App\Features\Api\GoogleApi;

use App\Features\Api\Support\AccessToken;
use App\Features\Api\Support\ChannelInfo;
use App\Features\Api\Support\YoutubeAuthException;
use App\Features\Api\Youtube;
use Exception;

class GoogleApiYoutube extends GoogleApi implements Youtube
{
    public function getAuthUrl() : string
    {
        return $this->client->createAuthUrl();
    }

    public function getAccessToken(array $queryParams) : AccessToken
    {
        if (! isset($queryParams['code'])) {
            throw new YoutubeAuthException();
        }
        $this->client->fetchAccessTokenWithAuthCode($queryParams['code']);
        $accessTokenArray = $this->client->getAccessToken();
        if (! isset($accessTokenArray['access_token'], $accessTokenArray['refresh_token'])) {
            throw new YoutubeAuthException();
        }

        return new AccessToken($accessTokenArray['access_token'], $accessTokenArray['refresh_token']);
    }

    public function getChannelInfo(AccessToken $accessToken) : ChannelInfo
    {
        $this->client->setAccessToken($accessToken->getAccessToken());
        $youtubeService = new \Google_Service_YouTube($this->client);
        try {
            $response = $youtubeService->channels->listChannels('snippet', ['mine' => true]);
            $channelInfo = $response->getItems()[0];
            $channelSnippet = $channelInfo->getSnippet();
        } catch (Exception $e) {
            throw new YoutubeAuthException($e);
        }

        return new ChannelInfo(
            $channelInfo->getId(),
            $channelSnippet->getTitle(),
            $channelSnippet->getThumbnails()
                ->getMedium()
                ->getUrl()
        );
    }
}
