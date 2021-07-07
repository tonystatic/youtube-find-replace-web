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
        string $uploadsPlaylistId
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
            'title'               => $title,
            'avatar'              => $avatar,
            'uploads_playlist_id' => $uploadsPlaylistId,
        ]);
        $channel->save();

        return $channel;
    }

    public function updateTokens(
        Channel &$channel,
        string $accessToken,
        string $refreshToken,
        int $tokenCreatedAt,
        int $tokenExpiresIn
    ) : void {
        $channel->update([
            'access_token'     => $accessToken,
            'refresh_token'    => $refreshToken,
            'token_created_at' => $tokenCreatedAt,
            'token_expires_in' => $tokenExpiresIn,
        ]);
    }
}
