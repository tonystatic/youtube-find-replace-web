<?php

declare(strict_types=1);

namespace App\Providers;

use App\Features\Youtube\GoogleClient\GoogleClientYoutubeAuth;
use App\Features\Youtube\YoutubeAuth;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register() : void
    {
        $this->app->bind(YoutubeAuth::class, GoogleClientYoutubeAuth::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot() : void
    {
        //
    }
}
