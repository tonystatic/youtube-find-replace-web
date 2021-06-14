<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Socialite;

class AuthController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('youtube')
            ->scopes((array) config('services.youtube.scopes'))
            ->redirect();
    }

    public function callback() : void
    {
        $user = Socialite::driver('youtube')->user();

        dd($user);
    }
}
