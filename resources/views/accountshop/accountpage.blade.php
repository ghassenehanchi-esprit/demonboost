@extends('base')

@section('title', 'Account Details')

@section('content')

    <div class="container pt-10 pb-13  pb-md-15" style="margin-top: 200px;">
    <div class="row">
    <div class="col-xl-8 col-12  order-xl-1 order-2 text-justify"style="max-width:700px;">
    <div class="card">
   
    <div class="card-body pt-0">
        <h2 class="display-6 mb-2" style="color: black;">{{ $account->server }} • {{ $account->rank }}</h2>
        <p style="color: black;">{{ $account->description }}</p>
    <div class="d-flex align-items-center gap-2">
    <p class="mb-0 lh-1 fw-normal" style="color: black;">Uploaded by <b>{{ $account->user->first_name }} {{ $account->user->last_name }} <i class="uil uil-check-circle align-bottom"></i></b></p>
    </div>
    <hr class="my-4">
    <div class="d-flex flex-wrap align-items-center justify-content-between">
    <div data-bs-toggle="tooltip" data-bs-placement="left">
    <img alt="skin" height="22px"src="{{ asset('img/valorant-logo.png') }}">
 
    <span><b>{{ $account->number_of_skins }}</b> <span class="d-md-inline-block d-none">Skins</span></span>
</div>
   
 
    
    </div>
    </div>
    </div>
    <div class="card mt-5">
    <div class="card-body">
    <h3 class="mb-4"style="color: black;">Overview</h3>
    <div class="row gx-lg-8 gx-xl-12 gy-8">
    <div class="col-md-4 col-lg-4">
    <div class="d-flex flex-row align-items-center">
    <div>
    <span class="avatar bg-soft-primary text-primary w-6 h-6 me-4">
    <img src="{{ asset('img/boost/'.$account->account_rank_image  ) }}" class="w-10" alt="Iron IV" style="max-width: 50px;">
    </span>
    </div>
    <div>
    <h4 class="mb-0 fw-bold"style="color: black;">{{ $account->rank}}</h4>
    </div>
    </div>
    </div>
    
   
  
    
 
    
    <div class="col-md-4 col-lg-4">
    <div class="d-flex flex-row align-items-center">
    <div>
    <span class="me-4">
    </span>
    </div>
    <div>
    <h4 class="mb-0 fw-bold"style="color: black;">{{ $account->level}}</h4>
    <p class="mb-0"style="color: black;">Level</p>
    </div>
    </div>
    </div>
    
    <div class="col-md-4 col-lg-4">
    <div class="d-flex flex-row align-items-center">
    <div>
    
    </div>
    <div>
    <h4 class="mb-0 fw-bold"style="color: black;">{{ $account->level_method}}</h4>
    <p class="mb-0"style="color: black;">Level Method</p>
    </div>
    </div>
    </div>
    
    </div>
    
    </div>
    </div>
   
    <div class="card mt-5">
    <div class="card-body">
    <h3 class="mb-4"style="color: black;">Gallery</h3>
    <div class="carousel owl-carousel blog grid-view gallery owl-loaded owl-drag" data-margin="15" data-nav="true" data-dots="true" data-autoplay="true" data-autoplay-timeout="5000" data-responsive="{&quot;0&quot;:{&quot;items&quot;: &quot;1&quot;}, &quot;768&quot;:{&quot;items&quot;: &quot;2&quot;}, &quot;1500&quot;:{&quot;items&quot;: &quot;2&quot;}}">
    <div class="owl-stage-outer"><div class="owl-stage"></div></div><div class="owl-nav disabled"><button type="button" role="presentation" class="owl-prev"><i class="uil-arrow-left"></i></button><button type="button" role="presentation" class="owl-next"><i class="uil-arrow-right"></i></button></div><div class="owl-dots disabled"></div></div><div class="mx-auto" style="max-width: 200px;"><figure class="hover-scale rounded cursor-dark">
       <!-- Add this code where you want to display the gallery photos -->
@if ($account->gallery)
@foreach (json_decode($account->gallery, true) as $photoPath)
    <img src="{{ asset('storage/' . $photoPath) }}" alt="Gallery Photo">
@endforeach
@else
<p>No gallery photos available.</p>
@endif

    </div>
    
    </div>
    </div>
    </div>
    
    <div class="col-xl-4 col-12 mb-5 order-xl-2 order-1"style="max-width:500px;">
    <div class="card sticky-top">
    <div class="card-body">
    <h2 class="fs-15 text-uppercase text-line text-navy"style="color: black;">ACCOUNT CHECKOUT</h2>
    <h3 class="display-3 mb-2"style="color: black;"><span class="currency-style">€</span>{{ $account->price}}</h3>
    <ul class="icon-list bullet-bg bullet-primary mt-4 mb-7">
    <li><i class="uil uil-check"></i><span><strong>Change</strong> Email &amp; Password</span></li>
    <li><i class="uil uil-check"></i><span><strong>Instant</strong> Delivery </span></li>
    <li><i class="uil uil-check"></i><span><strong>Lifetime</strong> Warranty </span></li>
    </ul>
    <div class="d-grid">
    <a href="{{ route('account-payment.show', ['id' => $account->id]) }}" class="btn btn-primary">Buy Now</a>
    </div>
    </div>
    </div>
    </div>
    
    </div>
    
    </div>
    
  
    @endsection