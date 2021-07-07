<?php

declare(strict_types=1);

namespace App\Features\Youtube;

use App\Features\Api\Support\ApiAuthException;
use App\Features\Api\Support\ApiAuthExpiredException;
use App\Features\Api\Support\ApiRequestException;
use App\Features\Youtube\Support\AuthException;
use App\Features\Youtube\Support\AuthExpiredException;
use App\Models\Channel;

class Auth extends Youtube
{
    public function getAuthUrl() : string
    {
        return $this->api->getAuthUrl();
    }

    /**
     * @param array $queryParams
     * @throws \App\Features\Youtube\Support\AuthException
     * @throws \App\Features\Youtube\Support\AuthExpiredException
     * @return \App\Models\Channel
     */
    public function authenticate(array $queryParams) : Channel
    {
        try {
            $tokens = $this->api->getTokens($queryParams);
            $channelInfo = $this->api->getChannelInfo($tokens);
        } catch (ApiAuthException | ApiRequestException $e) {
            throw new AuthException($e);
        } catch (ApiAuthExpiredException $e) {
            throw new AuthExpiredException($e);
        }

        $channel = $this->channelRepo->createOrUpdate(
            $channelInfo->getId(),
            $channelInfo->getTitle(),
            $channelInfo->getAvatar(),
            $channelInfo->getUploadsPlaylistId()
        );
        $this->channelRepo->updateTokens(
            $channel,
            $tokens->getAccessToken(),
            $tokens->getRefreshToken(),
            $tokens->getTokenCreatedAt(),
            $tokens->getTokenExpiresIn()
        );

        return $channel;
    }
}
