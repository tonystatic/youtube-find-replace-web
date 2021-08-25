@extends('layouts.app')

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
                @livewire('find-replace')
            </div>
        </div>
    </div>
@endsection
