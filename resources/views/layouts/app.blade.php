<!doctype html>
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
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
</head>
<body style="background-image: url('{{ asset('svg/bg.svg') }}')">
    <div id="app">
        <div class="nav-filler"></div>
        <div class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-elements" aria-controls="navbar-elements" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse of-x-clip px-2" id="navbar-elements">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            @guest
                                @if (Route::has('login'))
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                    </li>
                                @endif

                                @if (Route::has('register'))
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                    </li>
                                @endif
                            @else
                                <li class="nav-item dropdown ms-auto">
                                    <button class="btn btn-light dropdown-toggle d-flex align-items-center" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                        <img class="svg-icon" src="{{ asset('svg/user.svg') }}">
                                        {{ Auth::user()->name }}
                                    </button>

                                    <ul class="dropdown-menu cloudy-dropdown" aria-labelledby="dropdownMenuButton1">
                                        <li>
                                            <a class="dropdown-item d-flex align-items-center" href="{{ route('home') }}">
                                                <img class="svg-icon" src="{{ asset('svg/home.svg') }}">
                                                {{ __('Home') }}
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item d-flex align-items-center" href="#">
                                                <img class="svg-icon" src="{{ asset('svg/options.svg') }}">
                                                {{ __('Settings') }}
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item d-flex align-items-center" href="#">
                                                <img class="svg-icon" src="{{ asset('svg/support.svg') }}">
                                                {{ __('Help') }}
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item d-flex align-items-center" href="{{ route('logout') }}"
                                                onclick="event.preventDefault();
                                                            document.getElementById('logout-form').submit();">
                                                    <img class="svg-icon" src="{{ asset('svg/logoff.svg') }}">
                                                    {{ __('Logout') }}
                                            </a>
                                        </li>
                                        

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </ul>
                                </li>
                            @endguest
                        </li>
                    </ul>
                </div>
            </div>
         </div>
        
        
        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
