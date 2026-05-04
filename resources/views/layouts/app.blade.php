<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="icon" type="image/x-icon" href="{{dynamicAsset(path: 'public/assets/icons/favicon.ico')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{dynamicAsset(path: 'public/assets/icons/favicon-16x16.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{dynamicAsset(path: 'public/assets/icons/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="48x48" href="{{dynamicAsset(path: 'public/assets/icons/favicon-48x48.png')}}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{dynamicAsset(path: 'public/assets/icons/apple-touch-icon.png')}}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{dynamicAsset(path: 'public/assets/icons/android-chrome-192x192.png')}}">
    <link rel="icon" type="image/png" sizes="512x512" href="{{dynamicAsset(path: 'public/assets/icons/android-chrome-512x512.png')}}">

    <script src="{{ dynamicAsset(path: 'js/app.js') }}" defer></script>

    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <link href="{{ dynamicAsset(path: 'css/app.css') }}" rel="stylesheet">
</head>
<body>
<div id="app">
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'Laravel') }}
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ translate('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">

                </ul>

                <ul class="navbar-nav ml-auto">
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ translate('Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ translate('Register') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item logout-btn" href="{{ route('logout') }}">
                                    {{ translate('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <main class="py-4">
        @yield('content')
    </main>
</div>

<script>
    "use strict";
    $('.logout-btn').on('click', function (e) {
        e.preventDefault();
        document.getElementById('logout-form').submit()
    });
</script>
</body>
</html>
