@php
    /* @var string $step */
    /* @var int $updatedCount */
    /* @var \App\Features\Youtube\Support\FilteredVideos|null $videos */
@endphp

<div>
    @if ($step === 'search')
        <div class="card">
            <div class="card-body">
                <form wire:submit.prevent="submitSearch" action="#" method="post">
                    <div class="mb-3">
                        <label for="searchInput" class="form-label">Search</label>
                        <textarea wire:model="search" wire:loading.attr="disabled" wire:target="submitSearch" name="search" class="form-control" id="searchInput" rows="1" placeholder="Type your search here..." autocomplete="off" autofocus>{{ old('search') }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="replaceInput" class="form-label">Replace with</label>
                        <textarea wire:model="replace" wire:loading.attr="disabled" wire:target="submitSearch" name="replace" class="form-control" id="replaceInput" rows="1" placeholder="Type text to replace..." autocomplete="off">{{ old('replace') }}</textarea>
                    </div>
                    <p class="mb-1">Search in:</p>
                    <div class="mb-3">
                        <div class="form-check form-check-inline">
                            <input wire:model="searchInTitles" wire:loading.attr="disabled" wire:target="submitSearch" name="search_in_titles" class="form-check-input" type="checkbox" id="titleCheckbox" value="1" {{ old('search_in_titles', true) ? 'checked' : '' }}>
                            <label class="form-check-label" for="titleCheckbox">Titles</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input wire:model="searchInDescriptions" wire:loading.attr="disabled" wire:target="submitSearch" name="search_in_descriptions" class="form-check-input" type="checkbox" id="descriptionCheckbox" value="1" {{ old('search_in_descriptions', true) ? 'checked' : '' }}>
                            <label class="form-check-label" for="descriptionCheckbox">Descriptions</label>
                        </div>
                    </div>
                    <button wire:loading.attr="disabled" wire:target="submitSearch" type="submit" class="btn btn-primary">Start</button>
                </form>
            </div>
        </div>
    @elseif ($step === 'replace' && $videos !== null)
        <form wire:submit.prevent="submitReplace" action="#" method="post">
            @if ($videos->isNotEmpty())
                <button wire:loading.attr="disabled" wire:target="submitReplace" type="submit" class="btn btn-primary">Replace</button>
                <ul class="list-group mb-3 mt-3" style="max-height: 800px; overflow-y:auto; -webkit-overflow-scrolling: touch;">
                    @foreach ($videos->all() as $video)
                        <li class="list-group-item">
                            <input wire:model="selectedVideos" wire:loading.attr="disabled" wire:target="submitReplace" name="videos[]" value="{{ $video->attributes()->getId() }}" class="form-check-input me-1" type="checkbox" aria-label="...">
                            {{ $video->attributes()->getTitle() }}
                        </li>
                    @endforeach
                </ul>
                <button wire:loading.attr="disabled" wire:target="submitReplace" type="submit" class="btn btn-primary">Replace</button>
            @else
                <a href="{{ route('findReplace') }}" class="btn btn-primary">Search again</a>
            @endif
        </form>
    @elseif ($step === 'success')
        <div class="card">
            <div class="card-body">
                <div class="mb-3">Videos successfully updated: {{ $updatedCount }}.</div>
                <a href="{{ route('findReplace') }}" class="btn btn-primary">Search again</a>
            </div>
        </div>
    @endif
</div>
