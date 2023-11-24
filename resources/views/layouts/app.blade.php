<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link href="{{ asset('css/checks.css')}}" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <style>
    #app{
        /* background-color:#a1625d;
        color:white;
         */

    }
    .nav-link{
        /* color:white; */
    }
</style>
</head>

<body>    

    <div id="app">
    @if(Auth::user())
    @if(Auth::user()->role == "user")

        <nav class="navbar navbar-expand-md   shadow-sm fw-bolder fs-5">
            <div class="container text-white">
                <a class="navbar-brand text-warning fw-bolder fs-2" href="{{ url('/') }}">
                    <!-- {{ config('app.name', 'Laravel') }} -->
                    <!-- <img src="{{asset("/images/logo.png")}}" alt="order_image" style="width:100px;height:70px;"> -->
                    Cafeteria
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->

                    <ul class="navbar-nav me-auto ">
                        <a class="nav-link text-white" href="{{route('order-products.index')}}">Home</a>
                        <a class="nav-link" href="{{route('orders.index')}}">My Orders</a>
                       
                        <!-- @if(Auth::user()) -->
                        <!-- @if(Auth::user()->role == "admin")
                        <a class="nav-link" href="{{route('order-products.index')}}">Home</a>
                        <a class="nav-link" href="{{route('products.index')}}">Products</a>
                        <a class="nav-link" href="{{route('categories.index')}}">Categories</a>
                        <a class="nav-link" href="{{route('admins-orders.index')}}">Orders</a>
                        <a class="nav-link" href="{{route('checks.index')}}">Checks</a>
                        <a class="nav-link" href="{{route('branches.index')}}">Branches</a>
                        <a class="nav-link" href="{{route('admin-users.index')}}">Users</a>
                        @endif -->
                        <!-- @endif -->

                       
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

                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                @if(str_contains( auth()->user()->image, 'https'))
                                <img src="{{ auth()->user()->image }}" alt="avatar" width="32" height="32" style="margin-right: 8px;">
                                @else
                                <img src="{{ asset('images/'.Auth::user()->image) }}" alt="" style="width:50px;height:50px;">
                                @endif
                                {{ Auth::user()->name }}
                            </a>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('user.edit', auth()->user()->id) }}">
                                    edit profile
                                </a>
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
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
            @endif
            @endif

        </nav>
        <div class="main">
        <main class=" ">
            @yield('content')
        </main>
        <div class="">
            @yield('body')
        </div>
    </div>
    </div>

    <script src="{{ asset('js/checks.js')}}"></script>
</body>

</html>