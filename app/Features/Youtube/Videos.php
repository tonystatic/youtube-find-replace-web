<?php

declare(strict_types=1);

namespace App\Features\Youtube;

use App\Features\Api\Support\ApiAuthExpiredException;
use App\Features\Api\Support\ApiRequestException;
use App\Features\Api\Support\VideoItems;
use App\Features\Youtube\Support\AuthExpiredException;
use App\Features\Youtube\Support\FilteredVideo;
use App\Features\Youtube\Support\FilteredVideos;
use App\Features\Youtube\Support\RequestException;
use App\Models\Channel;

class Videos extends Youtube
{
    const SEARCH_IN_TITLES = 'titles';

    const SEARCH_IN_DESCRIPTIONS = 'descriptions';

    /**
     * @throws \App\Features\Youtube\Support\AuthExpiredException
     * @throws \App\Features\Youtube\Support\RequestException
     */
    public function search(
        Channel $channel,
        string $search,
        array $in = [self::SEARCH_IN_TITLES, self::SEARCH_IN_DESCRIPTIONS]
    ) : FilteredVideos {
        $tokens = $this->tokensOfChannel($channel);
        try {
            $videos = $this->api->getVideos($tokens, $channel->uploads_playlist_id);
        } catch (ApiRequestException $e) {
            throw new RequestException($e);
        } catch (ApiAuthExpiredException $e) {
            throw new AuthExpiredException($e);
        }
        $this->updateChannelTokens($channel, $tokens);

        return $this->filter($videos, $search, $in);
    }

    protected function filter(
        VideoItems $videos,
        string $search,
        array $in = [self::SEARCH_IN_TITLES, self::SEARCH_IN_DESCRIPTIONS]
    ) : FilteredVideos {
        $filteredVideos = new FilteredVideos();

        foreach ($videos->all() as $video) {
            $inTitles = $inDescriptions = false;
            if (
                \in_array(self::SEARCH_IN_TITLES, $in, true)
                && str_contains($video->getTitle(), $search)
            ) {
                $inTitles = true;
            }
            if (
                \in_array(self::SEARCH_IN_DESCRIPTIONS, $in, true)
                && str_contains($video->getDescription(), $search)
            ) {
                $inDescriptions = true;
            }
            if ($inTitles || $inDescriptions) {
                $filteredVideos->add(
                    new FilteredVideo($video, $inTitles, $inDescriptions)
                );
            }
        }

        return $filteredVideos;
    }

    /**
     * @throws \App\Features\Youtube\Support\AuthExpiredException
     * @throws \App\Features\Youtube\Support\RequestException
     */
    public function replace(
        Channel $channel,
        array $videoIds,
        string $search,
        string $replace,
        array $in = [self::SEARCH_IN_TITLES, self::SEARCH_IN_DESCRIPTIONS]
    ) : int {
        $tokens = $this->tokensOfChannel($channel);
        try {
            $videos = $this->api->getVideosByIds($tokens, $videoIds);
        } catch (ApiRequestException $e) {
            throw new RequestException($e);
        } catch (ApiAuthExpiredException $e) {
            throw new AuthExpiredException($e);
        }

        $filteredVideos = $this->filter($videos, $search, $in);

        dd($filteredVideos);

        foreach ($filteredVideos->all() as $filteredVideo) {
            // TODO: Implement video update
        }

        $this->updateChannelTokens($channel, $tokens);
    }
}
