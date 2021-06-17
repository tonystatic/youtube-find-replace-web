<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" itemscope itemtype="http://schema.org/WebSite" prefix="og: http://ogp.me/ns#">
    <head itemscope itemtype="http://schema.org/WebSite">
        @include('layouts.components.meta')
        <title>
            @yield('title') | {{ config('app.name') }}
        </title>
        <link href="{{ mix('assets/css/app.css') }}" rel="stylesheet" type="text/css" media="screen" />
        @stack('head')
    </head>
    <body itemscope itemtype="http://schema.org/WebPage">
        @stack('body-top')
        <main>
            @include('flash::message')
            @yield('content')
        </main>
        <script src="{{ mix('assets/js/app.js') }}" type="text/javascript"></script>
        @stack('body-bottom')
    </body>
</html>
