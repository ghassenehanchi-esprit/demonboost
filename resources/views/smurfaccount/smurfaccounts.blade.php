@extends('base')

@section('title', 'Smurf Shop')

@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

<section class="about_us section_padding">
    <div class="container">
        <div class="row align-items-center justify-content-between">
            <div class="col-md-5 col-lg-6 col-xl-6">
                <div class="learning_img">
                    <img src="{{ asset('img/reyna.png') }}" alt="" style="max-height:400px;">
                </div>
            </div>
            <div class="col-md-7 col-lg-6 col-xl-5">
                <div class="about_us_text">
                    <h2 style="color: white;">Smurf Accounts Shop
                    </h2>
                    <p>Welcome to our elite Smurf Accounts section, meticulously tailored for your exclusive gaming experience. Each account is specially crafted to meet your desires, ensuring a journey filled with excitement and challenges. Embark on a new gaming adventure today with our handcrafted Smurf Accounts.Welcome to our premium gaming account marketplace! Click below to explore a collection of unique accounts from fellow players. Dive into the details by selecting the account that catches your eye. Happy gaming!

                    </p>
                    
                </div>
            </div>
        </div>
    </div>
</section>
<div class="container-xxl pb-14 pb-md-16">
    <div class="pricing-wrapper position-relative mt-n18 mt-md-n20 mb-12 mb-md-15">
        <div class="shape bg-dot primary rellax w-16 h-18" data-rellax-speed="1" style="top: 2rem; right: -2.4rem;"></div>
        <div class="shape rounded-circle bg-line red rellax w-18 h-18 d-none d-lg-block" data-rellax-speed="1" style="bottom: 0.5rem; left: -2.5rem;"></div>
        <div class="col-12 align-self-center navigation d-flex justify-content-center" id="server-pick">
            <ul class="nav servers-list nav-tabs my-lg-2 justify-content-center mt-0 py-2 gap-1 border-0" role="tablist">
                <li class="nav-item mb-0 mr-3" role="presentation">
                    <a href="#EUROPE" data-bs-toggle="tab" class="nav-link active lift rounded" aria-selected="true" role="tab" onclick="selectServer('Europe', this.parentNode)">
                        <span class="d-md-block d-none">Europe</span>
                        <span class="d-md-none d-block px-md-0 px-3">EUROPE</span>
                    </a>
                </li>
                <li class="nav-item mb-0 mr-3" role="presentation">
                    <a href="#OCEANIA" data-bs-toggle="tab" class="nav-link lift rounded" aria-selected="false" tabindex="-1" role="tab" onclick="selectServer('Oceania', this.parentNode)">
                        <span class="d-md-block d-none">Oceania</span>
                        <span class="d-md-none d-block px-md-0 px-3">Oceania</span>
                    </a>
                </li>
                <li class="nav-item mb-0 mr-3" role="presentation">
                    <a href="#NA" data-bs-toggle="tab" class="nav-link lift rounded" aria-selected="false" tabindex="-1" role="tab" onclick="selectServer('North America', this.parentNode)">
                        <span class="d-md-block d-none">North America</span>
                        <span class="d-md-none d-block px-md-0 px-3">North America</span>
                    </a>
                </li>
                <li class="nav-item mb-0 mr-3" role="presentation">
                    <a href="#BRAZIL" data-bs-toggle="tab" class="nav-link lift rounded" aria-selected="false" tabindex="-1" role="tab" onclick="selectServer('Brazil', this.parentNode)">
                        <span class="d-md-block d-none">Brazil</span>
                        <span class="d-md-none d-block px-md-0 px-3">Brazil</span>
                    </a>
                </li>
                <li class="nav-item mb-0 mr-3" role="presentation">
                    <a href="#SOUTHEAST_ASIA" data-bs-toggle="tab" class="nav-link lift rounded" aria-selected="false" tabindex="-1" role="tab" onclick="selectServer('Southeast Asia', this.parentNode)">
                        <span class="d-md-block d-none">Southeast Asia</span>
                        <span class="d-md-none d-block px-md-0 px-3">Southeast Asia</span>
                    </a>
                </li>
            </ul>
        </div>

        <form method="POST" action="{{ route('smurf-order.create') }}">
            @csrf
            <input type="hidden" name="server" id="server" value="Europe">
            <input type="hidden" name="account_type" id="account_type" value="">
            <input type="hidden" name="price" id="price" value="">
    <div class="tab-content">
    <div class="tab-pane fade show active"  role="tabpanel">
    <div class="row gy-6 mt-3 mt-md-5" ><div class="col-md-6 col-lg-4 col-xl-3"style="max-width:300px;"><div class="pricing card text-center"><div class="card-body ionia">
        <img src="{{ asset('img/logo.png') }}" class="icon-svg icon-svg-xl text-primary mb-3" alt="ionia&quot;">
        <h4 class="card-title mb-2"style="color: black;">Basic</h4>
        <div class="prices text-dark"><div class="price price-show justify-content-center">
            <span class="currency-style price-currency fw-bolder">€</span><span class="price-value fw-bolder">4.99</span>
        </div>
    </div>
    <ul class="icon-list bullet-bg bullet-soft-primary mt-4 text-start">
        <li><i class="uil uil-check"></i>
            <span><b>40K</b> Blue Essence</span></li>
            <li><i class="uil uil-check"></i><span>Level ~30</span>
            </li><li><i class="uil uil-check"></i><span>Ranked Ready</span>
            </li><li><i class="uil uil-check"></i><span>Lifetime Warranty</span>
            </li>
        </ul>
        <button type="submit" id="basic-buy-now" onclick="selectAccountType('Basic')" class="btn btn-primary rounded px-10">Buy Now</button>
        <div class="package-abs-container mb-5" style="position:relative;width:100%;"></div>
        </div>
    </div>
</div>
<div class="col-md-6 col-lg-4 col-xl-3"style="max-width:300px;">
    <div class="pricing card text-center">
        <div class="card-body shadowisles">
            <img src="{{ asset('img/logo.png') }}" class="icon-svg icon-svg-xl text-primary mb-3" alt="shadowisles">
            <h4 class="card-title mb-2" style="color: black;">Starter</h4>
            <div class="prices text-dark">
                <div class="price price-show justify-content-center">
                    <span class="currency-style price-currency fw-bolder">€</span>
                    <span class="price-value fw-bolder">7.99</span>
                </div>
            </div>
            <ul class="icon-list bullet-bg bullet-soft-primary mt-4 text-start">
                <li><i class="uil uil-check"></i><span><b>50K</b> Blue Essence</span></li>
                <li><i class="uil uil-check"></i><span>Level ~30-40</span></li>
                <li><i class="uil uil-check"></i><span>Ranked Ready</span></li>
                <li><i class="uil uil-check"></i><span>Lifetime Warranty</span></li>
            </ul>
            <button type="submit"id="starter-buy-now" onclick="selectAccountType('Starter')" class="btn btn-primary rounded px-10">Buy Now</button>
            <div class="package-abs-container mb-5" style="position:relative;width:100%;"></div>
        </div>
    </div>
</div>
<div class="col-md-6 col-lg-4 col-xl-3" style="max-width:300px;">
    <div class="pricing card text-center">
        <div class="card-body noxus">
            <img src="{{ asset('img/logo.png') }}" class="icon-svg icon-svg-xl text-primary mb-3" alt="noxus&quot;">
            <h4 class="card-title mb-2"style="color: black;">Prime</h4>
            <div class="prices text-dark">
                <div class="price price-show justify-content-center">
                    <span class="currency-style price-currency fw-bolder">€</span>
                    <span class="price-value fw-bolder">9.99</span>
                </div>
            </div>
            <ul class="icon-list bullet-bg bullet-soft-primary mt-4 text-start">
                <li><i class="uil uil-check"></i><span><b>60K</b> Blue Essence</span></li>
                <li><i class="uil uil-check"></i><span>Level ~30-40</span></li>
                <li><i class="uil uil-check"></i><span>Ranked Ready</span></li>
                <li><i class="uil uil-check"></i><span>Lifetime Warranty</span></li>
            </ul>
            <button type="submit" id="prime-buy-now" onclick="selectAccountType('Prime')" class="btn btn-primary rounded px-10">Buy Now</button>
            <div class="package-abs-container mb-5" style="position:relative;width:100%;">
            </div>
        </div>
    </div>
</div>
<div class="col-md-6 col-lg-6 col-xl-3"style="max-width:300px;">
    <div class="pricing card text-center">
        <div class="card-body targon">
            <img src="{{ asset('img/logo.png') }}" class="icon-svg icon-svg-xl text-primary mb-3" alt="targon&quot;">
            <h4 class="card-title mb-2"style="color: black;">Supreme</h4>
            <div class="prices text-dark">
                <div class="price price-show justify-content-center">
                    <span class="currency-style price-currency fw-bolder">€</span>
                    <span class="price-value fw-bolder">19.99</span>
                </div>
            </div>
            <ul class="icon-list bullet-bg bullet-soft-primary mt-4 text-start">
                <li><i class="uil uil-check"></i><span><b>150K</b>  Blue Essence</span></li>
                <li><i class="uil uil-check"></i><span>Level ~60-70</span></li>
                <li><i class="uil uil-check"></i><span>Ranked Ready</span></li>
                <li><i class="uil uil-check"></i><span>Lifetime Warranty</span></li>
            </ul>
         
                <button type="submit" id="supreme-buy-now" onclick="selectAccountType('Supreme')" class="btn btn-primary rounded px-10">Buy Now</button>
                <div class="package-abs-container mb-5" style="position:relative;width:100%;">
                </div>
            </div>
        </div>
    </div>


    


    <div class="col-xl-12 d-xl-block d-none"style="max-width:1200px;">
        <div class="pricing horizontal-pricing targon card text-center">
            <div class="card-body d-xl-flex flex-xl-row justify-content-xl-around align-items-xl-center targon>">
                <div>
                    <img src="{{ asset('img/logo.png') }}" class="icon-svg icon-svg-xl text-primary mb-3" alt="targon&quot;">
                    <h4 class="card-title mb-2" style="color: black;">Ultimate</h4>
                </div>
                <ul class="icon-list bullet-bg bullet-soft-primary mt-4 text-start row">
                    <div class="col-xl-6">
                        <li><i class="uil uil-check"></i><span><b>150K</b>  Blue Essence</span></li>
                        <li><i class="uil uil-check"></i><span>Level ~60-70</span></li>
                        <div class="col-xl-6">
                            <li><i class="uil uil-check"></i><span>Ranked Ready</span></li>
                            <li><i class="uil uil-check"></i><span>Lifetime Warranty</span></li>
                        </div>
                    </div>
                </ul>
                <div>
                    <div class="prices text-dark">
                        <div class="price price-show justify-content-center position-relative">
                            <span class="currency-style price-currency fw-bolder">€</span>
                            <span class="price-value fw-bolder">27.99</span>
                        </div>
                    </div>
                    
                        <button type="submit" id="ultimate-buy-now" onclick="selectAccountType('Prime')" class="btn btn-primary rounded px-10">Buy Now</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    </div>
    
  
    </div>
</div>
</div>
<section class="about_us section_padding" style="margin-top: 5rem;">
    <div class="container">
        <div class="row align-items-center justify-content-between">
            
                <div class="about_us_text">
                    <h2 style="color: white;">VAL Account Shop 
                    </h2>
                    <p>Welcome to our exclusive Smurf Shop, a haven for discerning gamers seeking tailored experiences. Here, we take great pride in presenting our handcrafted Smurf Accounts, meticulously designed to cater to your individual needs and desires.

                    Join the ranks of savvy players who delight in the camaraderie of budget-friendly adventures with friends. Our Smurf Accounts provide the perfect opportunity to immerse yourself in team-based triumphs, forging unforgettable memories alongside your comrades.
                    
                    For those yearning to embrace a more dominant role, our Smurf Accounts empower you to become the guiding force, boosting your friends to victory and reveling in the satisfaction of leadership.
                    
                    Alternatively, venture into the thrilling realm of solo play, where you can test your mettle, hone your skills, and face challenges head-on. Our thoughtfully crafted Smurf Accounts grant you the confidence to tackle the unpredictable battlegrounds alone, emerging victorious as a seasoned conqueror.
                    
                    In this virtual universe, each account is meticulously tailored, ensuring that you have the tools to shape your destiny. Whether you seek lighthearted fun, intense competition, or a blend of both, our Smurf Accounts hold the key to unlocking a world of gaming wonders.
                    
                    Rest assured that our commitment to excellence extends beyond mere creation. Our dedicated team remains steadfast in providing you with unparalleled support and a secure gaming environment, ensuring your satisfaction at every step.
                    
                    Elevate your gaming experience with our exquisite Smurf Accounts and embark on a thrilling odyssey filled with triumph, friendship, and personal growth. Welcome to a realm where the extraordinary awaits – the Smurf Shop.
                    </p>
                   
            </div>
        </div>
    </div>
</section>
<script>
    // Function to handle server selection
    function selectServer(server, parentNode) {
        // Remove the "active" class from all server tabs
        const serverTabs = document.querySelectorAll('#server-pick .nav-link');
        serverTabs.forEach(tab => tab.classList.remove('active'));

        // Add the "active" class to the selected server tab
        parentNode.querySelector('.nav-link').classList.add('active');

        // Trigger the change event on the server select element
        serverSelect.value = server;
        serverSelect.dispatchEvent(new Event('change'));
    }

    // Function to initialize the page
    function initializePage() {
        const serverSelect = document.getElementById('server');
       
        const basicAccounts = @json($basicAccounts);
        const starterAccounts = @json($starterAccounts);
        const primeAccounts = @json($primeAccounts);
        const supremeAccounts = @json($supremeAccounts);
        const ultimateAccounts = @json($ultimateAccounts);

        function updateAccountAvailability() {
            const selectedServer = serverSelect.value;
            console.log(selectedServer);
            // Filter the account lists based on the selected server
            const filteredBasicAccounts = basicAccounts.filter(account => account.server === selectedServer);
            const filteredStarterAccounts = starterAccounts.filter(account => account.server === selectedServer);
            const filteredPrimeAccounts = primeAccounts.filter(account => account.server === selectedServer);
            const filteredSupremeAccounts = supremeAccounts.filter(account => account.server === selectedServer);
            const filteredUltimateAccounts = ultimateAccounts.filter(account => account.server === selectedServer);

            // Disable the "Buy Now" button and set text if no available accounts
            const basicBuyNowButton = document.getElementById('basic-buy-now');
            basicBuyNowButton.disabled = filteredBasicAccounts.length === 0;
            basicBuyNowButton.textContent = filteredBasicAccounts.length === 0 ? 'Out of Stock' : 'Buy Now';

            const starterBuyNowButton = document.getElementById('starter-buy-now');
            starterBuyNowButton.disabled = filteredStarterAccounts.length === 0;
            starterBuyNowButton.textContent = filteredStarterAccounts.length === 0 ? 'Out of Stock' : 'Buy Now';

            const primeBuyNowButton = document.getElementById('prime-buy-now');
            primeBuyNowButton.disabled = filteredPrimeAccounts.length === 0;
            primeBuyNowButton.textContent = filteredPrimeAccounts.length === 0 ? 'Out of Stock' : 'Buy Now';

            const supremeBuyNowButton = document.getElementById('supreme-buy-now');
            supremeBuyNowButton.disabled = filteredSupremeAccounts.length === 0;
            supremeBuyNowButton.textContent = filteredSupremeAccounts.length === 0 ? 'Out of Stock' : 'Buy Now';

            const ultimateBuyNowButton = document.getElementById('ultimate-buy-now');
            ultimateBuyNowButton.disabled = filteredUltimateAccounts.length === 0;
            ultimateBuyNowButton.textContent = filteredUltimateAccounts.length === 0 ? 'Out of Stock' : 'Buy Now';
        }

        // Initialize the page state
        updateAccountAvailability();

        // Add event listener for server selection
        serverSelect.addEventListener('change', updateAccountAvailability);
    }

    // Call the initialization function
    initializePage();
</script>

<script>
    const accountPrices = {
        'Basic': 4.99,
        'Starter': 7.99,
        'Prime': 9.99,
        'Supreme': 19.99,
        'Ultimate': 27.99
    };
    function selectAccountType(accountType) {
        // Get the price from the accountPrices object
        const price = accountPrices[accountType];
        document.getElementById('account_type').value = accountType;
        document.getElementById('price').value = price;
    }
</script>
<script>
    function selectServer(server, listItem) {
        // Set the value of the server input field
        document.getElementById('server').value = server;

        // Remove the 'active' class from all list items
        var listItems = listItem.parentNode.children;
        for (var i = 0; i < listItems.length; i++) {
            listItems[i].querySelector('a').classList.remove('active');
        }

        // Add the 'active' class to the selected list item
        listItem.querySelector('a').classList.add('active');

        // Trigger the change event on the server select element
        document.getElementById('server').dispatchEvent(new Event('change'));
    }
</script>


@endsection