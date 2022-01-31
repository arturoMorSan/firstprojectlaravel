<!doctype html>
<html class="no-js" lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="apple-mobile-web-app-capable" content="yes">

        <!-- DNS prefetch -->
        <link rel="dns-prefetch" href="//fonts.googleapis.com">

        <title>@yield('tab_title', config('app.name'))</title>
        <meta name="description" content="@yield('description')">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        @if (config('app.indexed') && view()->getSection('indexed') !== 'false')

            @if (view()->hasSection('canonical'))
                <link rel="canonical" href="@yield('canonical')">
            @endif

            <!-- Social networks -->
            <meta property="og:title" content="@yield('title')">
            <meta property="og:type" content="@yield('type', 'website')">
            <meta property="og:url" content="@yield('canonical')">
            <meta property="og:image" content="@yield('img', url('/img/social-thumb.png'))">
            <meta property="og:description" content="@yield('description')">
            <meta property="og:site_name" content="{{ config('app.name') }}">

        @else

            <meta name="robots" content="noindex, nofollow">

        @endif

        <!-- Icons -->
        

        <!-- CSS -->
        <link href="https://fonts.googleapis.com/css?family=Lato:300,400,400i,700,700i" rel="stylesheet">
        <link href="{{ version('css/main.css') }}" rel="stylesheet">
    </head>
    <body class="@yield('class')" data-root="{{ url('/') }}">
        <div id="app" class="app">
            <div id="bar" v-cloak>
                @include ('layout.user-bar')
            </div>

            @include('layout.header')

            <main id="main" class="main" role="main">
                @yield('content')
            </main>

            @include('layout.footer')

            <site-overlay></site-overlay>
            <toasts :initial="{{ json_encode($toast) }}"></toasts>
        </div>

        <!-- Scripts -->
        <script src="{{ version('js/vendor.js') }}"></script>
        <script src="{{ version('js/main.js') }}"></script>

        @yield('scripts')
    </body>
</html>

