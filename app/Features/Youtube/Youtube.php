<?php

declare(strict_types=1);

namespace App\Features\Youtube;

use App\Features\Api\Youtube as YoutubeApi;
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
}
