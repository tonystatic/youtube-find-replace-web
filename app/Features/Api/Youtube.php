<?php

declare(strict_types=1);

namespace App\Features\Api;

use App\Features\Api\Support\ChannelInfo;
use App\Features\Api\Support\Tokens;
use App\Features\Api\Support\VideoItems;

interface Youtube
{
    public function getAuthUrl() : string;

    /**
     * @throws \App\Features\Api\Support\ApiAuthException
     */
    public function getTokens(array $queryParams) : Tokens;

    /**
     * @throws \App\Features\Api\Support\ApiAuthExpiredException
     * @throws \App\Features\Api\Support\ApiRequestException
     */
    public function getChannelInfo(Tokens &$tokens) : ChannelInfo;

    /**
     * @throws \App\Features\Api\Support\ApiAuthExpiredException
     * @throws \App\Features\Api\Support\ApiRequestException
     */
    public function getVideos(Tokens &$tokens, string $uploadsPlaylistId) : VideoItems;
}
