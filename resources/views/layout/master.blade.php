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
        @include('layout.icons')

        <!-- CSS -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i&display=swap" rel="stylesheet">
        <link href="{{ version('css/main.css') }}" rel="stylesheet">
        <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    </head>
    <body class="@yield('class')" data-root="{{ url('/') }}">
        <div id="app">
            <div id="bar" v-cloak>
                @include ('layout.user-bar')
            </div>
            @if (!Request::is('login'))
                @include('layout.header', [
                    'activeLink' => view()->getSection('active_menu')
                ])
            @endif
            

            <main id="main" class="main" role="main">
                @yield('content')
            </main>

            @if (!Request::is('login'))
                @include('layout.footer')
            @endif

            

            <site-overlay></site-overlay>

        </div>
        @includeWhen(view()->hasSection('has_gallery'), 'components.gallery')

        <!-- Scripts -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="{{ version('js/vendor.js') }}"></script>
        <script src="{{ version('js/main.js') }}"></script>
        <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
        <script>
            AOS.init();
        </script>
        @yield('scripts')
    </body>
</html>
