<?php

declare(strict_types=1);

namespace App\Features\Youtube;

use App\Features\Api\Support\Tokens;
use App\Features\Api\Youtube as YoutubeApi;
use App\Models\Channel;
use App\Repos\ChannelRepo;

abstract class Youtube
{
    protected YoutubeApi $api;

    protected ChannelRepo $channelRepo;

    public function __construct(YoutubeApi $youtubeApi, ChannelRepo $channelRepo)
    {
        $this->api = $youtubeApi;
        $this->channelRepo = $channelRepo;
    }

    protected function tokensOfChannel(Channel $channel) : Tokens
    {
        return new Tokens(
            $channel->access_token,
            $channel->refresh_token,
            $channel->token_created_at,
            $channel->token_expires_in,
        );
    }

    protected function updateChannelTokens(Channel &$channel, Tokens $tokens) : void
    {
        if ($tokens->wereRefreshed()) {
            $this->channelRepo->updateTokens(
                $channel,
                $tokens->getAccessToken(),
                $tokens->getRefreshToken(),
                $tokens->getTokenCreatedAt(),
                $tokens->getTokenExpiresIn()
            );
            $tokens->setRefreshed(false);
        }
    }
}
