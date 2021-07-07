<?php

declare(strict_types=1);

namespace App\Features\Api\GoogleApi;

use App\Features\Api\Support\ApiAuthExpiredException;
use App\Features\Api\Support\Tokens;
use Google\Client;

abstract class GoogleApi
{
    /* @var \Google_Client */
    protected Client $client;

    public function __construct()
    {
        $client = new Client();
        $client->setClientId(config('services.google.client_id'));
        $client->setClientSecret(config('services.google.client_secret'));
        $client->addScope((array) config('services.google.scopes'));
        $client->setRedirectUri(url(config('services.google.redirect')));
        $client->setAccessType('offline');
        $client->setApprovalPrompt('force');
        $client->setIncludeGrantedScopes(true);

        $this->client = $client;
    }

    /**
     * @param \App\Features\Api\Support\Tokens $tokens
     * @throws \App\Features\Api\Support\ApiAuthExpiredException
     */
    protected function setTokensAndRefreshIfNeeded(Tokens &$tokens) : void
    {
        $this->client->setAccessToken([
            'access_token' => $tokens->getAccessToken(),
            'created'      => $tokens->getTokenCreatedAt(),
            'expires_in'   => $tokens->getTokenExpiresIn(),
        ]);
        if ($this->client->isAccessTokenExpired()) {
            $tokensArray = $this->client->fetchAccessTokenWithRefreshToken($tokens->getRefreshToken());
            if (! isset($tokensArray['access_token'], $tokensArray['refresh_token'])) {
                throw new ApiAuthExpiredException();
            }
            $tokens->setAccessToken($tokensArray['access_token'])
                ->setRefreshToken($tokensArray['refresh_token'])
                ->setTokenCreatedAt((int) $tokensArray['created'])
                ->setTokenExpiresIn((int) $tokensArray['expires_in'])
                ->setRefreshed();
        }
    }
}
