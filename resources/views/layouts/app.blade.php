<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <title>
        @if(Route::current()->getName()==='login') {{ __('messages.mentor_masuk') }} 
        @elseif(Route::current()->getName()==='register') {{ __('messages.mentor_daftar') }} 
        @elseif(Route::current()->getName()==='registersiswa') {{ __('messages.siswa_daftar') }} 
        @elseif(Route::current()->getName()==='loginsiswa') {{ __('messages.siswa_masuk') }}
        @elseif(Route::current()->getName()==='verification.notice') {{ __('messages.verifikasi') }}
        @endif
    </title>

    <!--
    <meta name="description" content="Latest updates and statistic charts">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
-->

    <!--begin::Base Styles -->
    <script src="{{ asset('js/app.js') }}" type="text/javascript" defer></script>
    <script src="{{ asset('js/scripts.bundle.js')}}" type="text/javascript" defer></script>
    <script src="{{ asset('js/vendors.bundle.js') }}" type="text/javascript" defer></script>


    <!--begin::Web font -->
    <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
    <script>
        WebFont.load({
            google: {"families":["Poppins:300,400,500,600,700","Roboto:300,400,500,600,700"]},
            active: function() {
                sessionStorage.fonts = true;
            }
          });
    </script>
    <!--end::Web font -->

    <!-- Fonts -->
    <!--
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
-->

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.bundle.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/vendors.bundle.css') }}" rel="stylesheet" type="text/css">
    <link rel="shortcut icon" href="{{asset('assets/demo/demo6/media/img/logo/favicon.ico')}}" />

</head>

<body>
    <div id="app">
        @guest @if (Route::has('register')) @endif @else
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        {{--
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Masuk') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Daftar') }}</a>
                        </li> --}}
                        
                            
                                   <div class="dropdown-item">Selamat datang {{ Auth::user()->username }}</div>

                           
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            
                        
                        @endguest
                    </ul>
                </div>


            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>

</html>