<?php

declare(strict_types=1);

namespace App\Repos;

use App\Models\Channel;

class ChannelRepo
{
    public function createOrUpdate(
        string $externalId,
        string $title,
        ?string $avatar,
        string $accessToken,
        string $refreshToken
    ) : Channel {
        $channel = Channel::query()
            ->firstWhere('external_id', $externalId);
        if ($channel === null) {
            $channel = new Channel();
            $channel->fill([
                'external_id' => $externalId,
            ]);
        }
        $channel->fill([
            'title'         => $title,
            'avatar'        => $avatar,
            'access_token'  => $accessToken,
            'refresh_token' => $refreshToken,
        ]);
        $channel->save();

        return $channel;
    }
}
