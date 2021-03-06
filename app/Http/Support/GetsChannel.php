<?php

declare(strict_types=1);

namespace App\Http\Support;

use App\Models\Channel;

trait GetsChannel
{
    protected function getChannel() : Channel
    {
        /* @var \App\Models\Channel $channel */
        $channel = auth()->user();

        return $channel;
    }
}
