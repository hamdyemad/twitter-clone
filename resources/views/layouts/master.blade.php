<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta id="csrf_token" name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Styles -->
    <link href="{{ asset('/css/libs/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/libs/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/style.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app" class="app">
        @include('layouts.navbar')
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-2">
                    @auth
                        @include('layouts.side-navbar')
                    @endauth
                </div>
                <div class="col-12 col-md-7">
                    @yield('content')
                </div>
                <div class="col-12 col-md-3">
                    @auth
                        @include('following')
                    @endauth
                </div>
            </div>
        </div>
    </div>
    @flasher_render
    <script src="/js/libs/jquery-3.6.0.min.js"></script>
    <script src="/js/libs/bootstrap.min.js"></script>
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
    <script>
        // Enable pusher logging - don't include this in production
            // Pusher.logToConsole = true;

            var pusher = new Pusher('1ff1c6e776e069c53081', {
            cluster: 'mt1'
            });
    </script>
    <script src="/js/app.js"></script>
    @yield('script')
</body>
</html>
