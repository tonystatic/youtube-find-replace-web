<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Features\Youtube\Auth;
use App\Features\Youtube\Support\AuthException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function redirect(Auth $auth) : RedirectResponse
    {
        return redirect()->to($auth->getAuthUrl());
    }

    /**
     * @throws \App\Features\Youtube\Support\AuthExpiredException
     */
    public function callback(Request $request, Auth $auth) : RedirectResponse
    {
        try {
            $channel = $auth->authenticate($request->all());
        } catch (AuthException $e) {
            flash()->error($e->getMessage());

            return redirect()->back();
        }

        auth()->login($channel, true);

        return redirect()->intended(route('home'));
    }

    public function logout() : RedirectResponse
    {
        auth()->logout();

        return redirect()->route('main');
    }
}
