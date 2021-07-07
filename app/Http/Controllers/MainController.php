<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class MainController extends Controller
{
    public function main() : View
    {
        return view('main');
    }

    public function home() : RedirectResponse
    {
        return redirect()->route('findReplace');
    }
}
