<?php

declare(strict_types=1);

namespace App\Http\Controllers;

class ReplaceController extends Controller
{
    public function index()
    {
        /* @var \App\Models\Channel $channel */
        $channel = auth()->user();

        return $channel->toArray();
    }
}
