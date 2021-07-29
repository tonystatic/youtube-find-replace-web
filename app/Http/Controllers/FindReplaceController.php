<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Features\Youtube\Support\RequestException;
use App\Features\Youtube\Videos;
use App\Http\Requests\SearchRequest;
use Illuminate\Contracts\View\View;

class FindReplaceController extends Controller
{
    public function index() : View
    {
        $channel = $this->getChannel();

        return view('search', [
            'channel' => $channel,
        ]);
    }

    /**
     * @throws \App\Features\Youtube\Support\AuthExpiredException
     */
    public function search(SearchRequest $request, Videos $videos)
    {
        $channel = $this->getChannel();

        $searchIn = [];
        if ($request->input('search_in_titles')) {
            $searchIn[] = Videos::SEARCH_IN_TITLES;
        }
        if ($request->input('search_in_descriptions')) {
            $searchIn[] = Videos::SEARCH_IN_DESCRIPTIONS;
        }
        try {
            $videos = $videos->search($channel, $request->input('search'), $searchIn);
        } catch (RequestException $e) {
            flash()->error($e->getMessage());

            return redirect()->back();
        }

        return view('replace', [
            'channel' => $channel,
            'videos'  => $videos,
        ]);
    }
}
