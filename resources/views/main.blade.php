@extends('layouts.main')

@section('title', 'Find & Replace for YouTube')

@section('content')
    <div class="px-4 py-5 mt-5 text-center">
        <img class="d-block mx-auto mb-4" src="{{ asset('assets/img/logo.png') }}" height="60">
        <h1 class="display-5 fw-bold">Find & Replace for YouTube</h1>
        <div class="col-lg-6 mx-auto">
            <p class="lead mb-4">Quickly design and customize responsive mobile-first sites with Bootstrap, the world’s most popular front-end open source toolkit, featuring Sass variables and mixins, responsive grid system, extensive prebuilt components, and powerful JavaScript plugins.</p>
            <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
                <button type="button" class="btn btn-danger btn-lg px-4 gap-3">Login via YouTube</button>
            </div>
        </div>
    </div>
{{--    <div class="container px-4 py-4" id="featured-3">--}}
{{--        <div class="row g-4 py-5 row-cols-1 row-cols-lg-3">--}}
{{--            <div class="feature col">--}}
{{--                <h2>Login via YouTube account</h2>--}}
{{--                <p>Paragraph of text beneath the heading to explain the heading. We'll add onto it with another sentence and probably just keep going until we run out of words.</p>--}}
{{--            </div>--}}
{{--            <div class="feature col">--}}
{{--                <h2>Specify your search</h2>--}}
{{--                <p>Paragraph of text beneath the heading to explain the heading. We'll add onto it with another sentence and probably just keep going until we run out of words.</p>--}}
{{--            </div>--}}
{{--            <div class="feature col">--}}
{{--                <h2>Perform bulk replace</h2>--}}
{{--                <p>Paragraph of text beneath the heading to explain the heading. We'll add onto it with another sentence and probably just keep going until we run out of words.</p>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
@endsection
