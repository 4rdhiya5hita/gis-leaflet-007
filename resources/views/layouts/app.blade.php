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

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <link href="{{ secure_asset('css/styles.css') }}" rel="stylesheet">
    <!-- Styles -->
    <!-- <link href="{{ secure_asset('css/app.css') }}" rel="stylesheet"> -->
    <!-- <link href="{{ secure_asset('css/navbar.css') }}" rel="stylesheet"> -->
    <style>
        body {
            font-size: 14px;
        }

        .btn {
            font-size: 14px;
        }

        .row {
            width: auto;
        }

        /* .col-bar{
            display: flex;
            justify-content: center;
            padding-left: 10px;
            padding-right: 10px;
            box-sizing: border-box;
            margin-left: 20px;
            margin-right: 20px;
            border: 0.5px solid black;
            border-radius: 20px;
        }
        .nav-item{
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .nav-link{
            font-size: large;
        } */
        .square-button {
            background-color: #fff;
            /* warna latar belakang */
            /* border: 1px solid #3989d4; */
            border: none;
            /* tidak ada border */
            color: black;
            /* warna teks */
            padding: 6px 12px;
            /* jarak antara teks dengan tepi */
            text-align: center;
            /* posisi teks */
            text-decoration: none;
            /* tidak ada garis bawah */
            display: inline-block;
            /* tampilkan sebagai block */
            font-size: 16px;
            /* ukuran teks */
            margin: 4px 2px;
            /* margin */
            transition-duration: 0.4s;
            /* durasi efek transisi */
            cursor: pointer;
            /* tampilan kursor */
            border-radius: 20px;
            /* border radius */
        }

        /* Efek hover */
        .square-button:hover {
            background-color: #3989d4;
            /* warna latar belakang saat dihover */
            box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
            /* bayangan */
        }

        .square-guest:hover {
            background-color: #e5f5a6;
            /* warna latar belakang saat dihover */
            box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
            /* bayangan */
        }

        /* Efek hover pada teks */
        .nav-link:hover {
            color: white;
            /* warna teks saat dihover */
        }

        /* Teks "Klik Saya" */
        .nav-link {
            color: black;
            display: inline-block;
            transition: color 0.4s ease-in-out;
            /* efek transisi warna */
        }

        .square-button-user {
            background-color: #fff;
            /* warna latar belakang */
            border: none;
            /* tidak ada border */
            color: black;
            /* warna teks */
            padding: 6px 12px;
            /* jarak antara teks dengan tepi */
            text-align: center;
            /* posisi teks */
            text-decoration: none;
            /* tidak ada garis bawah */
            display: inline-block;
            /* tampilkan sebagai block */
            font-size: 16px;
            /* ukuran teks */
            margin: 4px 2px;
            /* margin */
            transition-duration: 0.4s;
            /* durasi efek transisi */
            cursor: pointer;
            /* tampilan kursor */
            border-radius: 20px;
            /* border radius */
        }

        /* Efek hover */
        .square-button-user:hover {
            background-color: #e5f5a6;
            /* warna latar belakang saat dihover */
            box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
            /* bayangan */
        }

        .right{
            margin-left: auto;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;         
            width: fit-content;      
            height: 30px;      
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            border-radius: 10px;
            z-index: 1;
        }

        .dropdown-content a {
            padding: 8px 16px;
            text-decoration: none;
        }

        .square-button:hover .dropdown-content {
            display: block;
        }
    </style>
    @yield('styles')
</head>

<body>
    <div id="app">

        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <a class="navbar-brand" href="{{ url('map_sekolah_cluster') }}" style="font-size: large;">
                Menu GIS
            </a>
            <!-- <div class="container"> -->
                <div style="background-image: url('/img/bg-peta.jpg'); background-size: cover; width:100%; height:max-content;">
                <div class="" id="navbarSupportedContent" style="display: flex; justify-content: space-around;">
                    <div class="left">                    
                        @if(request()->is('map_sekolah_cluster'))
                            @yield('filter')    
                        @else
                            <div class="square-button">
                                <img src="{{ secure_asset('img/list-icon.png') }}" alt="User Avatar" class="img-circle mr-3" width="30" height="30">
                                <a class="nav-link dropbtn" href="{{ route('outlet_map.cluster') }}">{{ __('menu.our_outlets') }}</a>
                            </div>
                        @endif

                        @guest
                        <!-- Right Side Of Navbar -->
                        <div class="square-button">
                            <!-- Authentication Links -->

                            <img src="{{ secure_asset('img/edit-icon.png') }}" alt="User Avatar" class="img-circle mr-3" width="30" height="30">
                            <a class="nav-link" href="{{ route('login') }}">Edit</a>
                            <!-- @if (Route::has('register'))
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            @endif-->
                        </div>
                        <div class="square-button square-guest" style="border: 1px solid #e5f5ae">
                            <img src="{{ secure_asset('img/user-icon.png') }}" alt="User Avatar" class="img-circle mr-3" width="30" height="30">
                            <a class="nav-link">Guest Mode</a>
                        </div>
                        <div class="square-button">
                            <img src="{{ secure_asset('img/dashboard-icon.png') }}" alt="User Avatar" class="img-circle mr-3" width="30" height="30">
                            <a class="nav-link" href="{{ route('data.index') }}">Master Data</a>
                        </div>
                    </div>
                    <div class="right">
                        @else
                        <div class="square-button">
                            <img src="{{ secure_asset('img/dashboard-icon.png') }}" alt="User Avatar" class="img-circle mr-3" width="30" height="30">
                            <a class="nav-link" href="{{ route('data.index') }}">Master Data</a>
                        </div>
                        <div class="square-button">
                            <img src="{{ secure_asset('img/ebook-icon.png') }}" alt="User Avatar" class="img-circle mr-3" width="30" height="30">
                            <a class="nav-link" href="{{ route('outlets.index') }}">{{ __('outlet.list') }}</a>
                        </div>
                    </div>

                    <div class="right">
                        <div class="square-button-user">
                            <img src="{{ secure_asset('img/logout-icon.png') }}" alt="User Avatar" class="img-circle" width="30" height="30">
                            <a class="nav-link" style="color: black;" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                        <div class="square-button-user">
                            <img src="{{ secure_asset('img/account-icon.png') }}" alt="User Avatar" class="img-circle" width="30" height="30">
                            <a class="nav-link">
                                {{ Auth::user()->name }}
                            </a>
                        </div>
                    </div>
                    @endguest

                </div>
            <!-- </div> -->
        </nav>

        <main style="margin:20px">
            @yield('content')
        </main>
        @include('layouts.partials.footer')
    </div>
    <!-- Scripts -->
    <script src="{{ secure_asset('js/app.js') }}"></script>
    <!-- <script src="{{ secure_asset('js/navbar.js') }}"></script> -->
    @stack('scripts')
</body>

</html>