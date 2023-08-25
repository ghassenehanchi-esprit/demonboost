@extends('base')

@section('title', 'Home')

@section('content')
<section class="banner_part">
    <div class="container">
        <div class="row align-items-center justify-content-between">
            <div class="col-lg-6 col-md-8">
                <div class="banner_text">
                    <div class="banner_text_iner">
                        <h1>Valorant Accounts Shop</h1>
                        <p>Welcome to our premium gaming account marketplace! Click below to explore a collection of unique accounts from fellow players. Dive into the details by selecting the account that catches your eye. Happy gaming! </p>
                        <a href="{{ route('accountshop') }}" class="btn_1">Buy An Account</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-4"style="max-width:400px;">
                <div class="learning_img">
                    <img src="{{ asset('img/raze1.png') }}" alt="">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- banner part start-->

<!--::client logo part end::-->

<!--::client logo part end::-->

<!-- about_us part start-->
<section class="about_us section_padding"style="  background-image: none;";
">
    <div class="container">
        <div class="row align-items-center justify-content-between">
            <div class="col-md-5 col-lg-6 col-xl-6"style="max-width:400px;">
                <div class="learning_img">
                    <img src="{{ asset('img/jett.png') }}" alt="">
                </div>
            </div>
            <div class="col-md-7 col-lg-6 col-xl-5"style="max-width:500px;">
                <div class="about_us_text">
                    <h2>VALORANT Boosting  </h2>
                    <p>Elevate your gaming prowess instantly! Click the button below to access our esteemed Boosting Module, where your rank will soar to new heights. Unleash your full potential and conquer the gaming arena like never before. </p>
                    <a href="{{ route('rankboost') }}" class="btn_1">Rank Boost</a>
                    <a href="{{ route('placementboost') }}" class="btn_1">Placement Boost</a>
                    <a href="{{ route('winboost') }}" class="btn_1" style="margin-top: 2rem; margin-left: 6rem;">Win Boost</a>
                </div>
            </div>
           
        </div>
    </div>
</section>
<section class="banner_part">
    <div class="container">
        <div class="row align-items-center justify-content-between">
            <div class="col-lg-6 col-md-8">
                <div class="banner_text">
                    <div class="banner_text_iner">
                        <h1>Valorant Accounts Shop</h1>
                        <p>Welcome to our elite Smurf Accounts section, meticulously tailored for your exclusive gaming experience. Each account is specially crafted to meet your desires, ensuring a journey filled with excitement and challenges. Embark on a new gaming adventure today with our handcrafted Smurf Accounts. </p>
                        <a href="#" class="btn_1">Buy An Account</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- about_us part end-->


<!--::about_us part end::-->

<!-- use sasu part end-->

<!-- use sasu part end-->

<!-- gallery_part part start-->

<!-- gallery_part part end-->

<!-- use sasu part end-->

<!-- use sasu part end-->

<!-- pricing part start-->

<!-- pricing part end-->@endsection
