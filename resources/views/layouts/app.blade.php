<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link rel="stylesheet" type="text/css" href="https://cloud.typography.com/612324/7579192/css/fonts.css">
    <style>
      @import url("//hello.myfonts.net/count/3545d5");
        @font-face {font-family: 'Sabon';src: url(/assets/fonts/3545D5_0_0.eot);src: url(/assets/fonts/3545D5_0_0.eot?#iefix) format('embedded-opentype'),url(/assets/fonts/3545D5_0_0.woff2) format('woff2'),url(/assets/fonts/3545D5_0_0.woff) format('woff'),url(/assets/fonts/3545D5_0_0.ttf) format('truetype');font-weight:normal;font-weight:400;font-style:normal;}
        @font-face {font-family: 'Sabon';src: url(/dist/fonts/3545D5_1_0.eot);src: url(/dist/fonts/3545D5_1_0.eot?#iefix) format('embedded-opentype'),url(/dist/fonts/3545D5_1_0.woff2) format('woff2'),url(/dist/fonts/3545D5_1_0.woff) format('woff'),url(/dist/fonts/3545D5_1_0.ttf) format('truetype');font-weight:normal;font-weight:400;font-style:italic;}
        @font-face {font-family: 'Sabon';src: url(/dist/fonts/3545D5_2_0.eot);src: url(/dist/fonts/3545D5_2_0.eot?#iefix) format('embedded-opentype'),url(/dist/fonts/3545D5_2_0.woff2) format('woff2'),url(/dist/fonts/3545D5_2_0.woff) format('woff'),url(/dist/fonts/3545D5_2_0.ttf) format('truetype');font-weight:normal;font-weight:500;font-style:normal;}
    </style>
    <link href="/assets/styles/app.css" rel="stylesheet">
</head>
<body>
    <div id="a17">
      <header class="g-header">
        <div class="g-header__inner">
            <a href="#content" class="skip-nav f-body">Skip to Content</a>
            <nav aria-label="primary">
                      <a class="g-header__logo" aria-label="Art Institute of Chicago" href="/">
                <svg aria-hidden="true">
                  <use xlink:href="#icon--logo--80"></use>
                  <use xlink:href="#icon--logo--88"></use>
                  <use xlink:href="#icon--logo--92"></use>
                </svg>
              </a>
              <div class="g-header__nav-primary">
                <h2 class="sr-only" id="h-nav-primary-header">Primary Navigation</h2>
                <ul class="f-main-nav" aria-labelledby="h-nav-primary-header">
                        <li>
                            <a href="{{ route('doc-endpoints') }}">{{ __('Endpoints') }}</a>
                        </li>
                        <li>
                            <a href="{{ route('doc-fields') }}">{{ __('Fields') }}</a>
                        </li>
                        <li>
                            <a href="{{ route('doc-swagger') }}">{{ __('swagger.json') }}</a>
                        </li>
                </ul>
              </div>
            </nav>
            <nav class="g-header__nav-secondary" aria-label="secondary">
              <h2 class="sr-only" id="h-nav-secondary-header">Secondary Navigation</h2>
              <ul class="f-secondary" aria-labelledby="h-nav-secondary-header">
                    @guest
                    @else
                        <li class="dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>
                        </li>
                        <li>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
              </ul>
            </nav>
            <p class="g-header__opening-hours f-secondary"><!-- message here --></p>
            <button class="g-header__menu-link f-secondary" data-behavior="openNavMobile" aria-label="Show menu">Menu<svg class="icon--menu--24" aria-hidden="true"><use xlink:href="#icon--menu--24"></use></svg></button>
        </div>
        </header>
        <main class="content">
            <article class="o-article o-article--generic-page">
                @yield('content')
            </article>
        </main>
{{--
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                    </ul>
                </div>
            </div>
        </nav>
--}}
    </div>
</body>
</html>
