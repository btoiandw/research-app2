<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>
    <link rel="icon" href="https://research.kpru.ac.th/th/image/LogoRDI.png" type="image/icon type">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <!-- Styles -->
    {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}
    <link href="{{ asset('css/user.css') }}" rel="stylesheet" />
    <!--  jQuery -->
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>

    <!-- Isolated Version of Bootstrap, not needed if your site already uses Bootstrap -->
    <link rel="stylesheet" href="https://formden.com/static/cdn/bootstrap-iso.css" />

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Bootstrap Date-Picker Plugin -->
    <script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css" />

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
        top: 80px;
    }

    /* .dropdown-link{
        background: #E14D2A;
        color: #fff;
    } */
</style>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md nav ">
            <div class="container-fluid px-lg-5">
                <a class="navbar-brand text" href="{{ url('/') }}">
                    <img src="{{ asset('img/logo-kpru.png') }}" width="50px" height="60px" alt="logo" />
                    <img src="https://research.kpru.ac.th/th/image/LogoRDI.png" width="50px" height="60px"
                        alt="research-logo">
                    <span class="text-light font-weight-bold" style="font-size: 25px;">RDI-KPRU</span>
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

                            <li class="nav-item text dropdown">
                                <a class="nav-link nav-text dropdown-toggle" role="button" data-bs-toggle="dropdown"
                                    aria-expanded="false">{{ __('โครงร่างงานวิจัย') }}</a>
                                <ul class="dropdown-menu dropdown-link">
                                    <li><a class="dropdown-item" href="{{ route('user.dashboard') }}">หน้าหลัก</a></li>
                                    <li><a class="dropdown-item" href="#">โครงการทั้งหมด</a></li>
                                    <li><a class="dropdown-item" href="#">ฟอร์ตัวอย่าง</a></li>

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

        <main class="wrapper ">
            {{ Auth::user()->name }}
            @yield('content')
        </main>
    </div>
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>

    @include('sweetalert::alert')

</body>

</html>
