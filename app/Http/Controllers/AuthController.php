<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Features\Auth\Auth;
use App\Features\Auth\AuthException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function redirect(Auth $auth) : RedirectResponse
    {
        return redirect()->to($auth->getAuthUrl());
    }

    public function callback(Request $request, Auth $auth) : RedirectResponse
    {
        try {
            $authUser = $auth->getAuthUser($request->all());
        } catch (AuthException $e) {
            flash()->error($e->getMessage());

            return redirect()->back();
        }
        dd($authUser);
    }
}
