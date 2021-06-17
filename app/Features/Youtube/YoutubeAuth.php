<?php

declare(strict_types=1);

namespace App\Features\Youtube;

interface YoutubeAuth
{
    public function getAuthUrl() : string;

    /**
     * @param array $queryParams
     * @throws \App\Features\Youtube\YoutubeAuthException
     */
    public function getAccessToken(array $queryParams) : string;

    public function getEmail(string $accessToken) : string;
}
