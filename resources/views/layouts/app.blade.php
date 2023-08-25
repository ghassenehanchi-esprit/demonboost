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
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <script src="https://www.google.com/recaptcha/enterprise.js?render=6LfRxnomAAAAAN6JaBHWMxrzqnuOeRhz3FG0Kc3P" async defer></script>
    <script>
        function refreshCaptcha() {
            $.ajax({
                type: 'GET',
                url: '{{ route('captcha.refresh') }}',
                success: function (data) {
                    $('.captcha-refresh').html(data.captcha);
                }
            });
        }
    </script>
    <style>
        body {
            background-image: url('/img/valorant-background.jpg');
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
            margin: 0;
            padding: 0;
        }

        #app {
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

      
    </style>
</head>
<body>
        <header class="main_menu single_page_menu">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-12">
                        <nav class="navbar navbar-expand-lg navbar-light">
                            <a class="navbar-brand" href="/"> <img src="{{ asset('img/logo.png')}}" alt="logo"> </a>
                            <button class="navbar-toggler" type="button" data-toggle="collapse"
                                data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                                aria-expanded="false" aria-label="Toggle navigation">
                                <span class="menu_icon"><i class="fas fa-bars"></i></span>
                            </button>
    
                            <div class="collapse navbar-collapse main-menu-item" id="navbarSupportedContent">
                                <ul class="navbar-nav">
                                    <li class="nav-item">
                                        <a class="nav-link" href="/">Home</a>
                                    </li>
                                    <li class="nav-item dropdown">
                                        <a  class="nav-link dropdown-toggle" href="blog.html" id="navbarDropdown"
                                        role="button" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">Boost</a>
                                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                            <a class="dropdown-item" href="{{ route('rankboost') }}"> Rank Boost</a>
                                            <a class="dropdown-item" href="{{ route('placementboost') }}">Placement Boost</a>
                                            <a class="dropdown-item" href="{{ route('winboost') }}">Win Boost</a>
    
                                        </div>
                                    </li>
                                    <li class="nav-item dropdown">
                                        <a  class="nav-link dropdown-toggle" href="blog.html" id="navbarDropdown"
                                        role="button" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">Account Shops</a>
                                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                            <a class="dropdown-item" href="{{ route('smurf-accounts.showShop') }}"> Smurf Shop</a>
                                            <a class="dropdown-item" href="{{ route('accountshop') }}"> Account Shop</a>
    
    
                                        </div>
                                    </li>
                                    @auth
                                    <li class="nav-item dropdown">
                                        <a  class="nav-link dropdown-toggle" href="blog.html" id="navbarDropdown"
                                        role="button" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">My Profile</a>
                                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                            <a class="dropdown-item" href="{{ route('profile.show') }}">Profile</a>
                                            <a class="dropdown-item" href="{{ route('account.index') }}">My Accounts</a>
                                            <a class="dropdown-item" href="{{ route('orders') }}">My Orders</a>
    
    
                                        </div>
                                    </li>
                                    @endauth
    
                                </ul>
                            </div>
                         
                        
                        </nav>
                    </div>
                </div>
            </div>
        </header>
    
    <div id="app">
        <div class="container">
            @yield('content')
        </div>
    </div>
</body>
</html>
