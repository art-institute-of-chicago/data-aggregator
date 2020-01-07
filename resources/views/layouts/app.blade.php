<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="s-serif-loaded s-sans-serif-loaded">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script>!function(e){var t,s,i=window.A17||{},n=e.documentElement,l=window,a=e.getElementsByTagName("head")[0];function c(){if(/in/.test(e.readyState))setTimeout(c,9);else{var t=e.body,i=e.createElement("div");i.className="svg-sprite",i.innerHTML=s.responseText,t.insertBefore(i,t.childNodes[0])}}i.browserSpec=(e.querySelectorAll,"addEventListener"in l&&l.history.pushState&&e.implementation.hasFeature("http://www.w3.org/TR/SVG11/feature#BasicStructure","1.1")?"html5":"html4"),i.objectFit="objectFit"in n.style,window.A17=i,n.className=n.className.replace(/\bno-js\b/," js "+i.browserSpec+(i.objectFit?" objectFit":" no-objectFit")),"html4"===i.browserSpec?((t=e.createElement("link")).rel="stylesheet",t.title="html4css",t.href="/assets/styles/html4css.css",a.appendChild(t),(t=e.createElement("script")).src="//legacypicturefill.s3.amazonaws.com/legacypicturefill.min.js",a.appendChild(t),function t(){!e.readyState&&e.addEventListener&&(e.body?setTimeout(function(){e.readyState="complete"},500):setTimeout(t,9))}(),function t(){if(/in/.test(e.readyState))setTimeout(t,9);else for(var s=0;s<e.styleSheets.length;s++){var i=e.styleSheets[s];"html4css"!==i.title&&(i.disabled=!0)}}()):((t=e.createElement("script")).src="//cdnjs.cloudflare.com/ajax/libs/picturefill/3.0.3/picturefill.min.js",a.appendChild(t),(s=new XMLHttpRequest).open("GET","/assets/icons/icons.svg",!0),s.send(),s.onload=function(e){s.status>=200&&s.status<400&&c()})}(document);</script>
    <script src="https://vjs.zencdn.net/7.1.0/video.min.js"></script>
    <script src="/assets/scripts/app.js"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link rel="stylesheet" type="text/css" href="https://cloud.typography.com/612324/7579192/css/fonts.css">
    <style>
    @import url("//hello.myfonts.net/count/3545d5");
    @font-face {font-family: 'Sabon';src: url(/assets/fonts/3545D5_0_0.eot);src: url(/assets/fonts/3545D5_0_0.eot?#iefix) format('embedded-opentype'),url(/assets/fonts/3545D5_0_0.woff2) format('woff2'),url(/assets/fonts/3545D5_0_0.woff) format('woff'),url(/assets/fonts/3545D5_0_0.ttf) format('truetype');font-weight:normal;font-weight:400;font-style:normal;}
    @font-face {font-family: 'Sabon';src: url(/assets/fonts/3545D5_1_0.eot);src: url(/assets/fonts/3545D5_1_0.eot?#iefix) format('embedded-opentype'),url(/assets/fonts/3545D5_1_0.woff2) format('woff2'),url(/assets/fonts/3545D5_1_0.woff) format('woff'),url(/assets/fonts/3545D5_1_0.ttf) format('truetype');font-weight:normal;font-weight:400;font-style:italic;}
    @font-face {font-family: 'Sabon';src: url(/assets/fonts/3545D5_2_0.eot);src: url(/assets/fonts/3545D5_2_0.eot?#iefix) format('embedded-opentype'),url(/assets/fonts/3545D5_2_0.woff2) format('woff2'),url(/assets/fonts/3545D5_2_0.woff) format('woff'),url(/assets/fonts/3545D5_2_0.ttf) format('truetype');font-weight:normal;font-weight:500;font-style:normal;}
    .anchor a {
      position: absolute;
      left: 0px;
      top: -180px;
    }
    .anchor {
      position: relative;
    }
    </style>
    <link href="/assets/styles/app.css" rel="stylesheet">
      @if (config('services.google_tag_manager.enabled'))
        <!-- Google Tag Manager -->
        <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
        new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
        j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
        'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','{!! config('services.google_tag_manager.id') !!}');</script>
        <!-- End Google Tag Manager -->
      @endif
</head>
<body>
    @if (config('services.google_tag_manager.enabled'))
        <!-- Google Tag Manager (noscript) -->
        <noscript><iframe src="https://www.googletagmanager.com/ns.html?id={!! config('services.google_tag_manager.id') !!}"
        height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
        <!-- End Google Tag Manager (noscript) -->
    @endif
    <div id="a17">
        <header class="g-header">
            <div class="g-header__inner">
                <a href="#content" class="skip-nav f-body">Skip to Content</a>
                <nav aria-label="primary">
                    <a class="g-header__logo" aria-label="Art Institute of Chicago" href="/">
                        <svg aria-hidden="true">
                            <use xlink:href="#icon--logo--outline--80"></use>
                            <use xlink:href="#icon--logo--outline--88"></use>
                            <use xlink:href="#icon--logo--outline--92"></use>
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
                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
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
        <main id="content">
            <article id="app" class="o-article">
              <header class="m-article-header m-article-header--default ">
                <h1 class="title f-headline" itemprop="name" id="content-h1">{{ $title }}</h1>
              </header>
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
    <div class="svg-sprite">
        @php
            try {
                echo Storage::disk('public')->get('icons/icons.svg');
            } catch (\Illuminate\Contracts\Filesystem\FileNotFoundException $e) {
                // do nothing
            }
        @endphp
    </div>
</body>
</html>
