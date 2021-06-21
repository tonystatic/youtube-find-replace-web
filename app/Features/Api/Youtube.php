<?php

declare(strict_types=1);

namespace App\Features\Api;

use App\Features\Api\Support\AccessToken;
use App\Features\Api\Support\ChannelInfo;

interface Youtube
{
    public function getAuthUrl() : string;

    /**
     * @param array $queryParams
     * @throws \App\Features\Api\Support\YoutubeAuthException
     */
    public function getAccessToken(array $queryParams) : AccessToken;

    /**
     * @param \App\Features\Api\Support\AccessToken $accessToken
     * @throws \App\Features\Api\Support\YoutubeAuthException
     */
    public function getChannelInfo(AccessToken $accessToken) : ChannelInfo;
}
