<?php

declare(strict_types=1);

namespace App\Features\Api\GoogleApi;

use App\Features\Api\Support\ApiAuthException;
use App\Features\Api\Support\ApiRequestException;
use App\Features\Api\Support\ChannelInfo;
use App\Features\Api\Support\Tokens;
use App\Features\Api\Support\VideoItem;
use App\Features\Api\Support\VideoItems;
use App\Features\Api\Youtube;
use Exception;
use Google_Service_YouTube;

class GoogleApiYoutube extends GoogleApi implements Youtube
{
    public function getAuthUrl() : string
    {
        return $this->client->createAuthUrl();
    }

    public function getTokens(array $queryParams) : Tokens
    {
        if (! isset($queryParams['code'])) {
            throw new ApiAuthException();
        }
        $this->client->fetchAccessTokenWithAuthCode($queryParams['code']);
        $tokensArray = $this->client->getAccessToken();
        if (! isset($tokensArray['access_token'], $tokensArray['refresh_token'])) {
            throw new ApiAuthException();
        }

        return new Tokens(
            $tokensArray['access_token'],
            $tokensArray['refresh_token'],
            (int) $tokensArray['created'],
            (int) $tokensArray['expires_in'],
        );
    }

    public function getChannelInfo(Tokens &$tokens) : ChannelInfo
    {
        $this->setTokensAndRefreshIfNeeded($tokens);

        $youtubeService = new Google_Service_YouTube($this->client);
        try {
            $response = $youtubeService->channels->listChannels('snippet,contentDetails', ['mine' => true]);
            $channelInfo = $response->getItems()[0];
            $channelSnippet = $channelInfo->getSnippet();
            $contentDetails = $channelInfo->getContentDetails();
        } catch (Exception $e) {
            throw new ApiRequestException($e);
        }

        return new ChannelInfo(
            $channelInfo->getId(),
            $channelSnippet->getTitle(),
            $channelSnippet->getThumbnails()
                ->getMedium()
                ->getUrl(),
            $contentDetails->getRelatedPlaylists()
                ->getUploads(),
        );
    }

    public function getVideos(Tokens &$tokens, string $uploadsPlaylistId) : VideoItems
    {
        $this->setTokensAndRefreshIfNeeded($tokens);

        $youtubeService = new Google_Service_YouTube($this->client);
        $videos = new VideoItems();
        $nextPageToken = null;
        try {
            do {
                $response = $youtubeService->playlistItems->listPlaylistItems(
                    'snippet',
                    [
                        'playlistId' => $uploadsPlaylistId,
                        'maxResults' => 50,
                        'pageToken'  => $nextPageToken,
                    ],
                );
                foreach ($response->getItems() as $item) {
                    $videoSnippet = $item->getSnippet();
                    $videos->add(
                        new VideoItem(
                            $videoSnippet->getResourceId()->getVideoId(),
                            $videoSnippet->getTitle(),
                            $videoSnippet->getDescription(),
                            $videoSnippet->getThumbnails()
                                ->getMedium()
                                ->getUrl()
                        )
                    );
                }
                $nextPageToken = $response->getNextPageToken();
            } while ($nextPageToken !== null);
        } catch (Exception $e) {
            throw new ApiRequestException($e);
        }

        return $videos;
    }

    public function getVideosByIds(Tokens &$tokens, array $ids) : VideoItems
    {
        $this->setTokensAndRefreshIfNeeded($tokens);

        $youtubeService = new Google_Service_YouTube($this->client);
        $videos = new VideoItems();
        $nextPageToken = null;
        try {
            do {
                $response = $youtubeService->videos->listVideos(
                    'snippet',
                    [
                        'id'         => implode(',', $ids),
                        'maxResults' => 50,
                        'pageToken'  => $nextPageToken,
                    ],
                );
                foreach ($response->getItems() as $item) {
                    $videoSnippet = $item->getSnippet();
                    $videos->add(
                        new VideoItem(
                            $item->getId(),
                            $videoSnippet->getTitle(),
                            $videoSnippet->getDescription(),
                            $videoSnippet->getThumbnails()
                                ->getMedium()
                                ->getUrl()
                        )
                    );
                }
                $nextPageToken = $response->getNextPageToken();
            } while ($nextPageToken !== null);
        } catch (Exception $e) {
            throw new ApiRequestException($e);
        }

        return $videos;
    }
}
