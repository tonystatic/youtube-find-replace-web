@extends('layouts.base')

@php
    /* @var \App\Models\Channel $channel */
@endphp

@section('title', 'Find & Replace for YouTube')

@section('content')
    <div class="container mt-4 py-5">
        <div class="row">
            <div class="col-xxl-2 col-lg-3 col-md-4">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="row d-flex align-items-center">
                            <div class="col-xxl-5 col-xl-4 col-md-6 col-sm-2 col-3">
                                <img src="{{ $channel->avatar }}" class="img-fluid rounded-circle" alt="{{ $channel->title }} avatar">
                            </div>
                            <div class="col-xxl-7 col-xl-8 col-md-6 col-sm-10 col-9">
                                <a href="{{ $channel->link }}" class="fs-5 mb-0 d-block text-decoration-none text-truncate" target="_blank">{{ $channel->title }}</a>
                                <a href="{{ route('logout') }}" class="d-block link-danger small">Logout</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xxl-10 col-lg-9 col-md-8">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('findReplace.search') }}" method="post">
                            {!! csrf_field() !!}
                            <div class="mb-3">
                                <label for="searchInput" class="form-label">Search</label>
                                <textarea name="search" class="form-control" id="searchInput" rows="1" placeholder="Type your search here..." autocomplete="off">{{ old('search') }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label for="replaceInput" class="form-label">Replace with</label>
                                <textarea name="replace" class="form-control" id="replaceInput" rows="1" placeholder="Type text to replace..." autocomplete="off">{{ old('replace') }}</textarea>
                            </div>
                            <p class="mb-1">Search in:</p>
                            <div class="mb-3">
                                <div class="form-check form-check-inline">
                                    <input name="search_in_titles" class="form-check-input" type="checkbox" id="titleCheckbox" value="1" {{ old('search_in_titles', true) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="titleCheckbox">Titles</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input name="search_in_descriptions" class="form-check-input" type="checkbox" id="descriptionCheckbox" value="1" {{ old('search_in_descriptions', true) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="descriptionCheckbox">Descriptions</label>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Start</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
