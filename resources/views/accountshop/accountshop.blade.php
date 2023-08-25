@extends('base')

@section('title', 'Accounts Shop')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">

<section class="about_us section_padding">
    <div class="container">
        <div class="row align-items-center justify-content-between">
            <div class="col-lg-6 col-md-8">
                <div class="learning_img">
                    <img src="{{ asset('img/reyna.png') }}" alt="" style="max-height:400px;">
                </div>
            </div>
            <div class="col-lg-6 col-md-4">
                <div class="about_us_text">
                    <h2 style="color: white;">Valorant Accounts Shop
                    </h2>
                    <p>Welcome to our premium gaming account marketplace! Click below to explore a collection of unique accounts from fellow players. Dive into the details by selecting the account that catches your eye. Happy gaming!

                    </p>
                    
                </div>
            </div>
        </div>
    </div>
</section>



    <section class="wrapper bg-soft-primary">


    <div class="container inner py-8 gap-4 position-relative" id="account-grid">

        @foreach($accounts as $account)
        <div class="account-card">
            <div class="main-rank">
                <img src="{{ asset('img/boost/'.$account->account_rank_image  ) }}" alt="{{ $account->rank }}">
            </div>
            <div class="account-details">
                <span class="account_name text-uppercase text-truncate">{{ $account->server }} - {{ $account->rank }}</span>
                <div class="account-info">
                    <div class="center">
                        <span data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-original-title="{{ $account->number_of_skins }} Skin">
                            <img alt="skin" src="{{ asset('img/valorant-logo.png') }}">
                            <strong>{{ $account->number_of_skins }}</strong> Skin
                        </span>
                    </div>
                </div>
            </div>
            <div class="account-price">
                <span class="price_num">{{ $account->price }} EUR</span>
            </div>
            <div class="d-grid mt-3 text-center">
                <a href="{{ route('account.details', ['id' => $account->id]) }}" class="btn btn-primary">View Account</a>
            </div>
        </div>
        @endforeach
        
            </div>
        </section>
        <section class="about_us section_padding">
            <div class="container">
                <div class="row align-items-center justify-content-between">
                    
                        <div class="about_us_text">
                            <h2 style="color: white;">VAL Account Shop 
                            </h2>
                            <p>Welcome to our esteemed account shop!
                                At our platform, you can securely purchase accounts from other players, knowing that each transaction is backed by our meticulous verification process. Rest assured, only accounts from sellers verified by our dedicated team are made available for purchase here.
                                
                                We understand the importance of trust and safety when it comes to trading accounts, and that's why we have gone the extra mile to ensure that you can buy and sell with confidence. Our stringent verification procedures guarantee the authenticity and reliability of every account listed on our site.
                                
                                Whether you are a seasoned gamer looking to explore new challenges or a curious enthusiast seeking rare accounts, our diverse selection caters to all your gaming needs. Discover a treasure trove of verified accounts, each one ready to embark on new adventures in the virtual realms.
                                
                                We take pride in fostering a secure and supportive community of players, where your satisfaction is our priority. If you have any questions or need assistance, our team members are always here to help. Feel free to reach out via Discord or Email, as you'll find the contact information conveniently placed in the footer section of our website.
                                
                                Join us now and experience a seamless account-trading journey like never before. Welcome to our exclusive account shop, where trust and excellence converge. Happy gaming!
                                
                                To become a seller yourself, you must undergo a brief verification process to ensure one hundred percent security during the transaction and beyond. For further information regarding the verification process, please click on the "Verification" button or feel free to contact a team member via Discord or Email. Both communication channels can be found in the footer section of the website.
                            </p>
                           
                    </div>
                </div>
            </div>
        </section>


@endsection