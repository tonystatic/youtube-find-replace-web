<?php

declare(strict_types=1);

namespace App\Http\Livewire;

use App\Features\Youtube\Support\RequestException;
use App\Features\Youtube\Videos;
use Crypt;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class FindReplace extends Component
{
    use GetsChannel;

    /** Can be "search", "replace" or "success" */
    public string $step;

    public string $search;

    public string $replace;

    public bool $searchInTitles;

    public bool $searchInDescriptions;

    public ?string $serializedVideos = null;

    public array $selectedVideos;

    public function mount() : void
    {
        $this->step = 'search';

        $this->search = '';
        $this->replace = '';
        $this->searchInTitles = true;
        $this->searchInDescriptions = true;

        $this->selectedVideos = [];
    }

    public function render() : View
    {
        return view('livewire.find-replace', [
            'videos' => $this->serializedVideos !== null
                ? Crypt::decrypt($this->serializedVideos)
                : null,
        ]);
    }

    public function updatingSearchInTitles(bool $value) : void
    {
        if (! $value && ! $this->searchInDescriptions) {
            $this->searchInDescriptions = true;
        }
    }

    public function updatingSearchInDescriptions(bool $value) : void
    {
        if (! $value && ! $this->searchInTitles) {
            $this->searchInTitles = true;
        }
    }

    /**
     * @throws \App\Features\Youtube\Support\AuthExpiredException
     */
    public function submitSearch(Videos $videos) : void
    {
        $channel = $this->getChannel();

        $maxLength = $this->searchInTitles
            ? 100
            : 5000;

        $this->validate([
            'search'         => "required|string|max:$maxLength",
            'replace'        => "string|max:$maxLength",
            'searchInTitles' => 'required_without:searchInDescriptions',
        ], [
            'search.required'                 => 'Enter something to search field.',
            'search.max'                      => 'Search text must not exceed :max characters.',
            'replace.max'                     => 'Replace text must not exceed :max characters.',
            'searchInTitles.required_without' => 'Check titles or/and descriptions to search in.',
        ]);

        $searchIn = [];
        if ($this->searchInTitles) {
            $searchIn[] = Videos::SEARCH_IN_TITLES;
        }
        if ($this->searchInDescriptions) {
            $searchIn[] = Videos::SEARCH_IN_DESCRIPTIONS;
        }
        try {
            $videos = $videos->search($channel, $this->search, $searchIn);
        } catch (RequestException $e) {
            flash()->error($e->getMessage());

            return;
        }

        $this->serializedVideos = Crypt::encrypt($videos);
        $this->step = 'replace';
    }

    /**
     * @throws \App\Features\Youtube\Support\AuthExpiredException
     */
    public function submitReplace(Videos $videos) : void
    {
        $channel = $this->getChannel();

        $this->validate([
            'selectedVideos'   => 'nullable|array',
            'selectedVideos.*' => 'string',
        ], [
            'selectedVideos.array'    => 'Selected videos must be an array.',
            'selectedVideos.*.string' => 'Video ID has invalid format.',
        ]);

        $searchIn = [];
        if ($this->searchInTitles) {
            $searchIn[] = Videos::SEARCH_IN_TITLES;
        }
        if ($this->searchInDescriptions) {
            $searchIn[] = Videos::SEARCH_IN_DESCRIPTIONS;
        }
        try {
            $videosCount = $videos->replace($channel, $this->selectedVideos, $this->search, $this->replace, $searchIn);
        } catch (RequestException $e) {
            flash()->error($e->getMessage());

            return;
        }

        $this->step = 'success';
    }
}
