<?php

declare(strict_types=1);

namespace App\Features\Youtube;

use App\Features\Api\Support\AccessToken as YoutubeAccessToken;
use App\Features\Api\Support\YoutubeAuthException;
use App\Features\Youtube\Support\AccessToken;
use App\Features\Youtube\Support\AuthException;
use App\Models\Channel as ChannelModel;

class Channel extends Youtube
{
    /**
     * @param \App\Features\Youtube\Support\AccessToken $accessToken
     * @throws \App\Features\Youtube\Support\AuthException
     * @return \App\Models\Channel
     */
    public function createOrUpdate(AccessToken $accessToken) : ChannelModel
    {
        try {
            $channelInfo = $this->api->getChannelInfo(
                new YoutubeAccessToken($accessToken->getAccessToken(), $accessToken->getRefreshToken())
            );
        } catch (YoutubeAuthException $e) {
            throw new AuthException($e);
        }

        return $this->channelRepo->createOrUpdate(
            $channelInfo->getId(),
            $channelInfo->getTitle(),
            $channelInfo->getAvatar(),
            $accessToken->getAccessToken(),
            $accessToken->getRefreshToken()
        );
    }
}
