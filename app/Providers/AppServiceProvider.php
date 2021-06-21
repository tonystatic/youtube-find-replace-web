<?php

declare(strict_types=1);

namespace App\Providers;

use App\Features\Api\GoogleApi\GoogleApiYoutube;
use App\Features\Api\Youtube;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register() : void
    {
        $this->app->bind(Youtube::class, GoogleApiYoutube::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot() : void
    {
        //
    }
}
