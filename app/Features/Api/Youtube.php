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
     * @param array $queryParams
     * @throws \App\Features\Api\Support\ApiAuthException
     */
    public function getTokens(array $queryParams) : Tokens;

    /**
     * @param \App\Features\Api\Support\Tokens $tokens
     * @throws \App\Features\Api\Support\ApiAuthExpiredException
     * @throws \App\Features\Api\Support\ApiRequestException
     */
    public function getChannelInfo(Tokens &$tokens) : ChannelInfo;

    /**
     * @param \App\Features\Api\Support\Tokens $tokens
     * @param string $uploadsPlaylistId
     * @throws \App\Features\Api\Support\ApiAuthExpiredException
     * @throws \App\Features\Api\Support\ApiRequestException
     * @return \App\Features\Api\Support\VideoItems
     */
    public function getVideos(Tokens &$tokens, string $uploadsPlaylistId) : VideoItems;
}
