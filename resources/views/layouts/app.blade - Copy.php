<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ secure_asset('css/app.css') }}" rel="stylesheet">
    @yield('styles')
</head>
<body>
    <div id="app">
        
    <!-- <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'Laravel') }}
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarSupportedContent">                                        
                <ul class="navbar-nav ml-auto">                         -->
                    <!-- <li class="nav-item"><a class="nav-link" href="{{ route('outlet_map.index') }}">{{ __('menu.our_outlets') }}</a></li>                         -->
                    @guest                    
                    <a class="media" style="position: absolute; top: 0; right: 0;">                            
                        <img src="{{ secure_asset('img/user-icon.png') }}" alt="User Avatar" class="img-circle mr-3" width="50" height="50">                                
                    </a>         
                    <a class="media" style="position: absolute; bottom: 0; right: 0;" href="{{ route('login') }}">                            
                        <img src="{{ secure_asset('img/edit-icon.png') }}"
                        alt="User Avatar" class="img-circle mr-3" width="50" height="50">
                    </a>                    

                    @if (Route::has('register'))
                    <a class="media" style="position: absolute; bottom: 0; right: 50;" href="{{ route('register') }}">                            
                        <img src="{{ secure_asset('img/edit-icon.png') }}"
                        alt="User Avatar" class="img-circle mr-3" width="50" height="50">                        
                    </a>
                    @endif

                    @else
                            <a class="media" data-toggle="dropdown" href="#" role="button" style="position: absolute; top: 10px; right: 10px;">
                                <div class="" aria-labelledby="navbarDropdown">
                                <img src="{{ secure_asset('img/account-icon.png') }}" alt="User Avatar" class="img-circle mr-3" width="50" height="50">
                                    <a class="dropdown-item" >
                                        {{ __('Logout') }}
                                    </a>
                        
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </a>
                            <a class="media" data-toggle="dropdown" href="#" role="button" style="position: absolute; top: 70px; right: 10px;">                            
                                <img src="{{ secure_asset('img/logout-icon.png') }}"
                                    href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                    alt="User Avatar" class="img-circle mr-3" width="50" height="50">                                
                            </a>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('outlets.index') }}">{{ __('outlet.list') }}</a>
                            </li>
                            <li class="nav-item dropdown">
                                
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

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
                    <!-- </ul>
                </div>
            </div>
        </nav> -->
        

        <main class="">
            <!-- @yield('content') -->
        </main>
        @include('layouts.partials.footer')
    </div>
    <!-- Scripts -->
    <script src="{{ secure_asset('js/app.js') }}"></script>
    @stack('scripts')
</body>
</html>
