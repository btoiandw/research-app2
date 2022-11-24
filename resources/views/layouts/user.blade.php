<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/user.css') }}" rel="stylesheet" />
</head>
<style>
    .nav {
        background-color: #aa1616;
        -webkit-box-shadow: 0 24px 10px -20px rgba(0, 0, 0, 0.5);
        box-shadow: 0 24px 10px -20px rgba(0, 0, 0, 0.5);
        list-style: none;
        margin: 0;
        position: fixed;
        top: 0;
        z-index: 99;
        width: 100%;
        display: -webkit-box;
        display: -moz-box;
        display: -ms-flexbox;
        display: -webkit-flex;
        display: flex;
        align-items: center;
        -webkit-flex-flow: row wrap;
    }

    .nav-text {
        color: #ffffff;
    }

    .text {
        color: #fff;
    }

    .nav-text:hover {
        display: block;
        background-color: #fe4343;
        color: #EEEEEE;
           
    }

    .custom-toggler .navbar-toggler-icon {
        background-image: url("data:image/svg+xml;charset=utf8,%3Csvg viewBox='0 0 32 32' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath stroke='rgba(255,255,255, 0.75)' stroke-width='3' stroke-linecap='round' stroke-miterlimit='10' d='M4 8h24M4 16h24M4 24h24'/%3E%3C/svg%3E");
    }

    .custom-toggler.navbar-toggler {
        border: 0px;
    }

    .wrapper {
        display: -webkit-box;
        display: -moz-box;
        display: -ms-flexbox;
        display: -webkit-flex;
        display: flex;
        -webkit-flex-flow: row wrap;
        flex-flow: row wrap;
        /* font-weight: bold;*/
        /*text-align: center;*/
        position: relative;
        top: 112px;
    }
    /* .dropdown-link{
        background: #E14D2A;
        color: #fff;
    } */
</style>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md nav ">
            <div class="container">
                <a class="navbar-brand text" href="{{ url('/') }}">
                    <img src="{{ asset('img/logo-kpru.png') }}" width="50px" height="60px" alt="logo" />
                </a>
                <button class="navbar-toggler custom-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
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
                            <li class="nav-item">
                                <a class="nav-link nav-text" href="{{ route('user.dashboard') }}">{{ __('หน้าหลัก') }}</a>
                            </li>

                            <li class="nav-item dropdown">
                                <a class="nav-link nav-text dropdown-toggle" role="button" data-bs-toggle="dropdown"
                                    aria-expanded="false"
                                    href="{{ route('user.dashboard') }}">{{ __('โครงร่างงานวิจัย') }}</a>
                                <ul class="dropdown-menu dropdown-link">
                                    <li><a class="dropdown-item" href="#">Action</a></li>
                                    <li><a class="dropdown-item" href="#">Another action</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item dropdown-link" href="#">Something else here</a></li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link nav-text" href="">{{ __('งานวิจัย') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link nav-text" href="">{{ __('งานตีพิมพ์เผยแพร่') }}</a>
                            </li>
                            <hr />
                            <li class="nav-item">
                                <a class="nav-link nav-text" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('ออกจากระบบ') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>

                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="wrapper">

            @yield('content')


        </main>
    </div>
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous">
    </script>
    @include('sweetalert::alert')

</body>

</html>
