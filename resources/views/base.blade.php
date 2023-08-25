<!-- base.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <!-- Add your CSS stylesheets here -->
    <link rel="icon" href="{{ asset('img/favicon.png') }}">
<!-- Bootstrap CSS -->
<link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
<!-- animate CSS -->
<link rel="stylesheet" href="{{ asset('css/animate.css') }}">
<!-- owl carousel CSS -->
<link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}">
<!-- font awesome CSS -->
<link rel="stylesheet" href="{{ asset('css/all.css') }}">
<!-- flaticon CSS -->
<link rel="stylesheet" href="{{ asset('css/flaticon.css') }}">
<link rel="stylesheet" href="{{ asset('css/themify-icons.css') }}">
<!-- font awesome CSS -->
<link rel="stylesheet" href="{{ asset('css/magnific-popup.css') }}">
<!-- swiper CSS -->
<link rel="stylesheet" href="{{ asset('css/slick.css') }}">
<!-- style CSS -->
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
<link rel="stylesheet" href="{{ asset('css/nice-select.css') }}">

</head>
<body>
    <div class="body_bg">
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
                        @auth
                       
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: inline;">
        @csrf
        <button type="submit" class="btn_1 d-none d-sm-block">Logout</button>
    </form>
                    @else
                        <a href="{{ route('login') }}" class="btn_1 d-none d-sm-block" style="margin-right: 40px;">Sign In</a>
                        <a href="{{ route('register') }}" class="btn_1 d-none d-sm-block">Sign Up</a>
                    @endauth
                    
                    </nav>
                </div>
            </div>
        </div>
    </header>

    <main>
        @yield('content')
    </main>

    <footer class="footer_part">
        <div class="footer_top">
            <div class="container">
                <div class="row">
                    <!-- Add the image column -->
                    <div class="col-12">
                        <img src="{{ asset('img/pay.png')}}" alt="Your Image">
                    </div>
                    <!-- End image column -->
    
                    <div class="col-sm-6 col-lg-3">
                        <div class="single_footer_part">
                            <a href="index.html" class="footer_logo_iner"> <img src="{{ asset('img/logo.png')}}" alt="#"> </a>
                            <p>Heaven fruitful doesn't over lesser days appear creeping seasons so behold bearing
                                days
                                open
                            </p>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="single_footer_part">
                            <h4>Contact Info</h4>
                            <p>Address : Your address goes
                                here, your demo address.
                                Bangladesh.</p>
                            <p>Phone : +8880 44338899</p>
                            <p>Email : info@colorlib.com</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="copygight_text">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-8">
                        <div class="copyright_text">
                            <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                                Copyright &copy;
                                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    
    <!-- jquery plugins here-->
    <script src="{{ asset('js/jquery-1.12.1.min.js')}}"></script>
    <!-- popper js -->
    <script src="{{ asset('js/popper.min.js')}}"></script>
    <!-- bootstrap js -->
    <script src="{{ asset('js/bootstrap.min.js')}}"></script>
    <!-- easing js -->
    <script src="{{ asset('js/jquery.magnific-popup.js')}}"></script>
    <!-- swiper js -->
    <script src="{{ asset('js/swiper.min.js')}}"></script>
    <!-- swiper js -->
    <script src="{{ asset('js/masonry.pkgd.js')}}"></script>
    <!-- particles js -->
    <script src="{{ asset('js/owl.carousel.min.js')}}"></script>
    <!-- slick js -->
    <script src="{{ asset('js/slick.min.js')}}"></script>
    <script src="{{ asset('js/jquery.counterup.min.js')}}"></script>
    <script src="{{ asset('js/waypoints.min.js')}}"></script>
    <script src="{{ asset('js/contact.js')}}"></script>
    <script src="{{ asset('js/jquery.ajaxchimp.min.js')}}"></script>
    <script src="{{ asset('js/jquery.form.js')}}"></script>
    <script src="{{ asset('js/jquery.validate.min.js')}}"></script>
    <script src="{{ asset('js/mail-script.js')}}"></script>
    <!-- custom js -->
    <script src="{{ asset('js/custom.js')}}"></script>
</div>
</body>
</html>
