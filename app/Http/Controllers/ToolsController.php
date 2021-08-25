<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;

class ToolsController extends Controller
{
    public function findReplace() : View
    {
        $channel = $this->getChannel();

        return view('find-replace', [
            'channel' => $channel,
        ]);
    }
}
