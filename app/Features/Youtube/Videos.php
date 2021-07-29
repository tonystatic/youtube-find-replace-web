<?php

declare(strict_types=1);

namespace App\Features\Youtube;

use App\Features\Api\Support\ApiAuthExpiredException;
use App\Features\Api\Support\ApiRequestException;
use App\Features\Youtube\Support\AuthExpiredException;
use App\Features\Youtube\Support\RequestException;
use App\Models\Channel;

class Videos extends Youtube
{
    const SEARCH_IN_TITLES = 'titles';

    const SEARCH_IN_DESCRIPTIONS = 'descriptions';

    /**
     * @param array|string[] $in
     * @throws \App\Features\Youtube\Support\AuthExpiredException
     * @throws \App\Features\Youtube\Support\RequestException
     */
    public function search(
        Channel $channel,
        string $search,
        array $in = [self::SEARCH_IN_TITLES, self::SEARCH_IN_DESCRIPTIONS]
    ) : void {
        $tokens = $this->accessTokenFromChannel($channel);
        try {
            $videos = $this->api->getVideos($tokens, $channel->uploads_playlist_id);
        } catch (ApiRequestException $e) {
            throw new RequestException($e);
        } catch (ApiAuthExpiredException $e) {
            throw new AuthExpiredException($e);
        }
        $this->updateChannelTokens($channel, $tokens);

        dd($videos);
    }
}
