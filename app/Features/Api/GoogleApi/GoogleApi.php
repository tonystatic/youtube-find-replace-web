<?php

declare(strict_types=1);

namespace App\Features\Api\GoogleApi;

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
}
