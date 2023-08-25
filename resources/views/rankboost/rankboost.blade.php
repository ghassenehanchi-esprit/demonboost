@extends('base')

@section('title', 'Rank Boost')

@section('content')

<meta name="csrf-token" content="{{ csrf_token() }}">

<section class="about_us section_padding">
    <div class="container">
        <div class="row align-items-center justify-content-between">
            <div class="col-lg-6 col-md-8">
                <div class="learning_img">
                    <img src="{{ asset('img/jett.png') }}" alt=""style="max-height:400px;">
                </div>
            </div>
            <div class="col-lg-6 col-md-4">
                <div class="about_us_text">
                    <h2 style="color: white;">VAL Rank Boosting
                    </h2>
                    <p>The booster will login and play from your account until you reach your desired rank.

                    </p>
                    
                </div>
            </div>
        </div>
    </div>
</section>
<section class="wrapper bg-soft-primary">
    <div class="container inner py-6 py-md-8">
      <form action="{{ route('rank.boost.order') }}" method="POST" id="val_boost_form" class="boost-form" autocomplete="off">
        @csrf

        <div class="row">
          <div class="col-lg-7 text-start navigation">
           
            <input type="text" id="total_price" name="total_price" value="" hidden="">
            <input type="text" id="p_with_booster" name="p_with_booster" value="" hidden="">
            <input type="text" id="is_priority" name="is_priority" value="" hidden="">
            <input type="text" id="sp_agent" name="sp_agent" value="" hidden="">
            <input type="text" id="current_rank" name="current_rank" value="" hidden="">
            <input type="text" id="desired_rank" name="desired_rank" value="" hidden="">
            <input type="text" id="Server" name="Server" value="" hidden="">
            <input type="text" id="current_rr1" name="current_rr1" value="" hidden="">
            
     
            <div class="card card-border-start border-silver" id="start_card">
              <div class="card-body">
                <div class="d-md-flex align-items-center gap-4 d-block text-start">
                    <div class="h-13 d-flex align-items-center">
                      <img id="start_rank_img" src="/img/boost/11.png" width="70px" style="margin-right: 20px;">
                    </div>
                    <div>
                      <h3 class="card-title display-5 mb-2" style="color: black;">Current Rank</h3>
                      <p class="card-text d-md-block d-none" id="start_helper_txt" style="color: black;">Please select your Current Rank and Division.</p>
                    </div>
                  </div>
                  
  
                <div class="row mt-5">
                  <div class="col-12 text-start">
                    <input class="radio-btn" type="radio" name="start_tier" value="1" id="current-iron" checked>
                    <label class="lift itooltip itooltip-iron mr-2 iron" title="Iron" id="label-current-iron" for="current-iron">
                      <img class="rank-select-mini" src="{{ asset('img/boost/11.png') }}">
                    </label>
                    
                    <input class="radio-btn" type="radio" name="start_tier" value="2" id="current-bronze">
                    <label class="lift itooltip itooltip-bronze mr-2 bronze" title="Bronze" id="label-current-bronze" for="current-bronze">
                      <img class="rank-select-mini" src="{{ asset('img/boost/21.png') }}">
                    </label>
                    
                    <input class="radio-btn" type="radio" name="start_tier" value="3" id="current-silver">
                    <label class="lift itooltip itooltip-silver mr-2 silver" title="Silver" id="label-current-silver" for="current-silver">
                      <img class="rank-select-mini" src="{{ asset('img/boost/31.png') }}">
                    </label>
                    
                    <input class="radio-btn" type="radio" name="start_tier" value="4" id="current-gold">
                    <label class="lift itooltip itooltip-gold mr-2 gold" title="Gold" id="label-current-gold" for="current-gold">
                      <img class="rank-select-mini" src="{{ asset('img/boost/41.png') }}">
                    </label>
                    
                    <input class="radio-btn" type="radio" name="start_tier" value="5" id="current-platinum">
                    <label class="lift itooltip itooltip-platinum mr-2 platinum" title="Platinum" id="label-current-platinum" for="current-platinum">
                      <img class="rank-select-mini" src="{{ asset('img/boost/51.png') }}">
                    </label>
                    
                    <input class="radio-btn" type="radio" name="start_tier" value="6" id="current-diamond">
                    <label class="lift itooltip itooltip-diamond mr-2 diamond" title="Diamond" id="label-current-diamond" for="current-diamond">
                      <img class="rank-select-mini" src="{{ asset('img/boost/61.png') }}">
                    </label>
                    
                    <input class="radio-btn" type="radio" name="start_tier" value="7" id="current-ascendant">
                    <label class="lift itooltip itooltip-ascendant mr-2 ascendant" title="Ascendant" id="label-current-ascendant" for="current-ascendant">
                      <img class="rank-select-mini" src="{{ asset('img/boost/71.png') }}">
                    </label>
                    
                    <input class="radio-btn" type="radio" name="start_tier" value="8" id="current-immortal">
                    <label class="lift itooltip itooltip-immortal mr-2 immortal" title="Immortal" id="label-current-immortal" for="current-immortal">
                      <img class="rank-select-mini" src="{{ asset('img/boost/81.png') }}">
                    </label>
                  </div>
                </div>
  
                <div class="row mt-3">
                    <div class="col-12 text-start">
                      <div class="division-container">
                        <input class="radio-btn visually-hidden" type="radio" name="start_division" value="1" id="division-i" checked>
                        <label class="lift mr-2 division-select" for="division-i">
                        <div> I</div>
                        </label>
                        <input class="radio-btn visually-hidden" type="radio" name="start_division" value="2" id="division-ii">
                        <label class="lift mr-2 division-select" for="division-ii">
                          <div> II</div>
                        </label>
                        <input class="radio-btn visually-hidden" type="radio" name="start_division" value="3" id="division-iii">
                        <label class="lift mr-2 division-select" for="division-iii">
                          <div> III</div>
                        </label>
                      </div>
                    </div>
                   
                      
                  </div>
                <div class="row"> 
                  <div class="col-lg-5 col-6 mb-2">
                    <p class="card-text mb-0" style="color:black;"><strong>Current RR</strong></p>
                    <div class="form-select-wrapper">
                      <select class="form-select" name="current_rr" id="current_rr" aria-label="Select Current RR">
                        <optgroup label="Select Current RR:">
                          <option value="0-20">0-20</option>
                          <option value="21-40">21-40</option>
                          <option value="41-60">41-60</option>
                          <option value="61-80">61-80</option>
                          <option value="81-100">81-100</option>
                        </optgroup>
                      </select>
                    </div>
                  </div>
                  <div class="col-lg-5 col-6 mb-2">
                    <p class="card-text mb-0" style="color:black;"><strong>Server</strong></p>
                    <div class="form-select-wrapper">
                      <select class="form-select" name="start_lp" id="start_lp" aria-label="Select Current RR">
                        <optgroup label="Select Current RR:">
                          <option value="Europe">Europe</option>
                          <option value="North America">North America</option>
                          <option value="Oceania">Oceania</option>
                          <option value="Brazil">Brazil</option>
                          <option value="Southest East">Southest East</option>
                        </optgroup>
                      </select>
                    </div>
                  </div>
                </div>
                  
                  <input type="hidden" id="selected_server" name="selected_server" value="">
            <!-- Continue with the rest of the code -->
          </div>
        </div>
        <div class="card card-border-start border-silver" id="end_card">
            <div class="card-body">
              <div class="d-md-flex align-items-center gap-4 d-block text-start">
                <div class="h-13 d-flex align-items-center">
                  <img id="end_rank_img" src="/img/boost/11.png" width="70px" style="margin-right: 20px;">
                </div>
                <div>
                  <h3 class="card-title display-5 mb-2" style="color: black;">Desired Rank</h3>
                  <p class="card-text d-md-block d-none" id="end_helper_txt" style="color: black;">Please select your Desired Rank and Division.</p>
                </div>
              </div>
          
              <div class="row mt-5">
                <div class="col-12 text-start">
                  <input class="radio-btn" type="radio" name="desired_tier" value="1" id="desired-iron" checked>
                  <label class="lift itooltip itooltip-iron mr-2 iron" title="Iron" id="label-desired-iron" for="desired-iron">
                    <img class="rank-select-mini" src="{{ asset('img/boost/11.png') }}">
                  </label>
          
                  <input class="radio-btn" type="radio" name="desired_tier" value="2" id="desired-bronze">
                  <label class="lift itooltip itooltip-bronze mr-2 bronze" title="Bronze" id="label-desired-bronze" for="desired-bronze">
                    <img class="rank-select-mini" src="{{ asset('img/boost/21.png') }}">
                  </label>
          
                  <input class="radio-btn" type="radio" name="desired_tier" value="3" id="desired-silver">
                  <label class="lift itooltip itooltip-silver mr-2 silver" title="Silver" id="label-desired-silver" for="desired-silver">
                    <img class="rank-select-mini" src="{{ asset('img/boost/31.png') }}">
                  </label>
          
                  <input class="radio-btn" type="radio" name="desired_tier" value="4" id="desired-gold">
                  <label class="lift itooltip itooltip-gold mr-2 gold" title="Gold" id="label-desired-gold" for="desired-gold">
                    <img class="rank-select-mini" src="{{ asset('img/boost/41.png') }}">
                  </label>
          
                  <input class="radio-btn" type="radio" name="desired_tier" value="5" id="desired-platinum">
                  <label class="lift itooltip itooltip-platinum mr-2 platinum" title="Platinum" id="label-desired-platinum" for="desired-platinum">
                    <img class="rank-select-mini" src="{{ asset('img/boost/51.png') }}">
                  </label>
          
                  <input class="radio-btn" type="radio" name="desired_tier" value="6" id="desired-diamond">
                  <label class="lift itooltip itooltip-diamond mr-2 diamond" title="Diamond" id="label-desired-diamond" for="desired-diamond">
                    <img class="rank-select-mini" src="{{ asset('img/boost/61.png') }}">
                  </label>
          
                  <input class="radio-btn" type="radio" name="desired_tier" value="7" id="desired-ascendant">
                  <label class="lift itooltip itooltip-ascendant mr-2 ascendant" title="Ascendant" id="label-desired-ascendant" for="desired-ascendant">
                    <img class="rank-select-mini" src="{{ asset('img/boost/71.png') }}">
                  </label>
          
                  <input class="radio-btn" type="radio" name="desired_tier" value="8" id="desired-immortal">
                  <label class="lift itooltip itooltip-immortal mr-2 immortal" title="Immortal" id="label-desired-immortal" for="desired-immortal">
                    <img class="rank-select-mini" src="{{ asset('img/boost/81.png') }}">
                  </label>
                  <input class="radio-btn" type="radio" name="desired_tier" value="9" id="desired-radiant">
                  <label class="lift itooltip itooltip-immortal mr-2 radiant" title="radiant" id="label-desired-radiant" for="desired-radiant">
                    <img class="rank-select-mini" src="{{ asset('img/boost/90.png') }}">
                  </label>
                </div>
              </div>
          
              <div class="row mt-3">
                <div class="col-12 text-start">
                  <div class="division-container">
                    <input class="radio-btn visually-hidden" type="radio" name="desired_division" value="1" id="desired_division-i" checked>
                    <label class="lift mr-2 division-select" for="desired_division-i">
                      <div> I</div>
                    </label>
                    <input class="radio-btn visually-hidden" type="radio" name="desired_division" value="2" id="desired_division-ii">
                    <label class="lift mr-2 division-select" for="desired_division-ii">
                      <div> II</div>
                    </label>
                    <input class="radio-btn visually-hidden" type="radio" name="desired_division" value="3" id="desired_division-iii">
                    <label class="lift mr-2 division-select" for="desired_division-iii">
                      <div> III</div>
                    </label>
                  </div>
                </div>
              </div>
          
              <!-- Continue with the rest of the code -->
            </div>
          </div>
        </div>
        <div class="col-lg-5 mt-lg-6 mt-5  text-start navigation">
          <div class="card sticky-lg-top card-border-start border-primary">
            <div class="card-body px-0">
              <div class="text-center">
                <h2 class="card-title display-5 mb-8"style="color:black;">Checkout</h2>
              </div>
              <div class="row selected-options px-6 my-3 py-3 ms-1 me-0 bg-soft-primary">
                <div class="col-1 my-auto p-0">
                  <i class="uil uil-minus display-5"></i>
                </div>
                <div class="col-4 text-center my-auto p-0">
                  <div class="rank-icon mt-1">
                    <img id="sum_start_rank_img" src="/img/boost/11.png" width="70px">
                  </div>
                  <p class="selected-rank mb-0" style="text-transform: capitalize; " id="sum_start_rank" name="sum_start_rank" >
                    Iron 1
                  </p>
                  
                  
                </div>
                <div class="col-2 my-auto p-0 arrow-down-mob text-center">
                  <i class="uil uil-arrow-right display-5 text-dark"></i>
                </div>
                <div class="col-4 text-center my-auto p-0">
                  <div class="rank-icon mt-1">
                  <img id="sum_end_rank_img" src="/img/boost/11.png" width="70px" >
                  </div>
                  <p class="selected-rank mb-0" style="text-transform:capitalize;" id="sum_end_rank">Iron 1</p>
                </div>
                <div class="col-1 my-auto p-0">
                  <i class="uil uil-minus display-5 "></i>
                </div>
              </div>
              <div class="px-6 pt-1">
                <div class="d-flex justify-content-between align-items-center mb-2" tabindex="0" data-bs-toggle="popover" data-bs-trigger="hover" data-bs-placement="left" title="Play with Booster" data-bs-content="Play with the booster from your own account.">
                  <label class="d-flex align-items-center gap-2" for="is_duo" style="cursor:pointer">
                    Play With Booster
                    <span class="badge bg-pale-red text-red rounded">+50%</span>
                  </label>
                  <label class="switch s-icons s-outline s-outline-primary d-inline-block">
                    <input type="checkbox" value="1" name="is_duo" id="is_duo"> <span class="slider round"></span>
                  </label>
                </div>

                <div class="d-flex justify-content-between align-items-center mb-2" tabindex="0" data-bs-toggle="popover" data-bs-trigger="hover" data-bs-placement="left" title="Play with Booster" data-bs-content="Play with the booster from your own account.">
                  <label class="d-flex align-items-center gap-2" for="agents" style="cursor:pointer">
                    Pick Agents
                    <span class="badge bg-pale-green text-green rounded">Free</span>
                  </label>
                  <label class="switch s-icons s-outline s-outline-primary d-inline-block">
                    <input type="checkbox" value="1" name="agents" id="agents"> <span class="slider round"></span>
                  </label>
                </div>
                <div class="modal fade" id="agents-modal" data-bs-backdrop="false" tabindex="-1" style="display: none;" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered modal-sm ">
                  <div class="modal-content text-start">
                  <div class="modal-body">
                  <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                  <h3 class="mb-1 d-flex gap-2">Pick Agents <span class="badge bg-pale-green text-green rounded lh-xxs">FREE</span></h3>
                  <div class="mt-3">
                  <select class="ss-select" name="agents[]" id="agents" multiple="" tabindex="-1" data-ssid="ss-97774" aria-hidden="true" style="display: none;" data-gtm-form-interact-field-id="1">
                  <option value="Astra">Astra</option><option value="Breach">Breach</option><option value="Brimstone">Brimstone</option><option value="Chamber">Chamber</option><option value="Cypher">Cypher</option><option value="Fade">Fade</option><option value="Harbor">Harbor</option><option value="Jett">Jett</option><option value="KAY/O">KAY/O</option><option value="Killjoy">Killjoy</option><option value="Neon">Neon</option><option value="Omen">Omen</option><option value="Phoenix">Phoenix</option><option value="Raze">Raze</option><option value="Reyna">Reyna</option><option value="Sage">Sage</option><option value="Skye">Skye</option><option value="Sova">Sova</option><option value="Viper">Viper</option><option value="Yoru">Yoru</option> </select><div class="ss-97774 ss-main ss-select" style=""><div class="ss-multi-selected"><div class="ss-values"><span class="ss-disabled">No agents selected</span></div><div class="ss-add"><span class="ss-plus"></span></div></div><div class="ss-content"><div class="ss-search"><input type="search" placeholder="Search" tabindex="0" aria-label="Search" autocapitalize="off" autocomplete="off" autocorrect="off"></div><div class="ss-list" role="listbox"><div class="ss-option" role="option" data-id="7663833">Astra</div><div class="ss-option" role="option" data-id="35987090">Breach</div><div class="ss-option" role="option" data-id="60467694">Brimstone</div><div class="ss-option" role="option" data-id="76567506">Chamber</div><div class="ss-option" role="option" data-id="16044944">Cypher</div><div class="ss-option" role="option" data-id="23827657">Fade</div><div class="ss-option" role="option" data-id="59531242">Harbor</div><div class="ss-option" role="option" data-id="42510888">Jett</div><div class="ss-option" role="option" data-id="84152592">KAY/O</div><div class="ss-option" role="option" data-id="13179225">Killjoy</div><div class="ss-option" role="option" data-id="26203390">Neon</div><div class="ss-option" role="option" data-id="82463892">Omen</div><div class="ss-option" role="option" data-id="90915900">Phoenix</div><div class="ss-option" role="option" data-id="27689009">Raze</div><div class="ss-option" role="option" data-id="87252836">Reyna</div><div class="ss-option" role="option" data-id="18514200">Sage</div><div class="ss-option" role="option" data-id="32037802">Skye</div><div class="ss-option" role="option" data-id="58975337">Sova</div><div class="ss-option" role="option" data-id="38927241">Viper</div><div class="ss-option" role="option" data-id="77383246">Yoru</div></div></div></div>
                 
                
                </div>

                  <div class="mt-5 d-grid gap-2">
                  <button class="btn btn-primary btn-lg rounded" type="button" data-bs-dismiss="modal" aria-label="Confirm">Confirm</button>
                  </div>
                  
                  </div>
                  
                  </div>
                  
                  </div>
                  
                  </div>
                <div class="d-flex justify-content-between align-items-center mb-2" tabindex="0" data-bs-toggle="popover" data-bs-trigger="hover" data-bs-placement="left" title="Play with Booster" data-bs-content="Play with the booster from your own account.">
                  <label class="d-flex align-items-center gap-2" for="priority" style="cursor:pointer">
                    Priority Boost
                    <span class="badge bg-pale-red text-red rounded">+25%</span>
                  </label>
                  <label class="switch s-icons s-outline s-outline-primary d-inline-block">
                    <input type="checkbox" value="1" name="priority" id="priority"> <span class="slider round"></span>
                  </label>
                </div>


                <!-- Rest of the code -->
              </div>
              <div class="row px-6 pt-3 align-items-center">
                <div class="col-sm-6 col-7 text-start grand-total-title">
                  <span class="card-text fs-25 text-dark">Total Price: </span>
                </div>
                
                <div class="col-sm-6 col-5 text-end grand-total-amount">
                  <a class="d-flex align-items-center justify-content-end" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <h3 class="text-primary display-4 d-flex align-items-center">
                      <i class="uil uil-angle-down fw-bolder fs-25 pt-1"></i>
                      <span class="data-currency">€</span>
                      <span id="price_total" data-price="0.00" class="data-price" style="font-size: 30px;">0.00</span>
                    </h3>
                  </a>
                  
                </div>
              </div>
              <div class="px-6 pt-1 d-grid gap-2">
                <button name="submit" type="submit" class="btn btn-primary btn-block w-100"id="buy_boost_button">
                  <span class="indicator-label">Buy Boost Now</span>
                </button>
              </div>
              
            </div>
          </div>
        </div>
        
          
      </form>
    </div>
    </div>
  </section>
  <section class="about_us section_padding">
    <div class="container">
        <div class="row align-items-center justify-content-between">
            
                <div class="about_us_text">
                    <h2 style="color: white;">VAL Rank Boosting
                    </h2>
                    <p>Welcome to our prestigious Boosting Module!

                      Step into a realm of gaming excellence where your aspirations meet unmatched skill. Here, you have the power to define your destiny, for we are dedicated to helping you achieve the rank you desire. Simply provide us with your current rank and the rank you envision, and our team of seasoned boosters will embark on a mission to swiftly attain your desired outcome.
                      
                      Whether you believe you deserve a higher standing among your peers, yearn to explore new challenges at an advanced level, or simply seek to impress your friends, this option is the epitome of gaming empowerment.
                      
                      Our boosters are not just skilled players; they are artists of the virtual arena, committed to crafting a masterpiece of your gaming journey. You can trust in their expertise and dedication to ensure your success. We take pride in delivering results promptly, without compromising on quality or safety.
                      
                      Rise through the ranks with confidence, knowing that your gaming experience is in the hands of true professionals. Embrace the thrill of victory as you surge towards unparalleled achievements.
                      
                      So, hesitate no more. Empower your gaming endeavors today with our Boosting Module, and let your gaming prowess shine like a beacon of triumph! Welcome to the pinnacle of gaming excellence.

                    </p>
                   
            </div>
        </div>
    </div>
</section>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    // Define the createRankBoostOrder function
function createRankBoostOrder(totalPrice) {
  // Retrieve the values from the form inputs
  const pWithBooster = document.getElementById('p_with_booster').value;
  const isPriority = document.getElementById('is_priority').value;
  const spAgent = document.getElementById('sp_agent').value;
  const currentRank = document.getElementById('current_rank').value;
  const desiredRank = document.getElementById('desired_rank').value;
  const server = document.getElementById('Server').value;
  const currentRR = document.getElementById('current_rr1').value;

  // Construct the request body
  const requestBody = {
    totalPrice,
    pWithBooster,
    isPriority,
    spAgent,
    currentRank,
    desiredRank,
    server,
    currentRR
  };

  // Send the request to create the RankBoost order
  fetch('/create-rank-boost-order', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      'X-CSRF-TOKEN': csrfToken, // Include the CSRF token in the headers
    },
    body: JSON.stringify(requestBody),
  })
  .then(response => response.json())
  .then(data => {
    // Log the response data for debugging
    console.log('Response Data:', data);

    // Redirect to the appropriate page or update the UI as needed
    // ...

  })
  .catch(error => {
    // Log the error for debugging
    console.error('Error creating RankBoost order:', error);
    // Update the UI to display an error message
    // ...
  });
}
    let rankBoosts = [];
  
    // Function to update the selected rank text and image
    function updateSelectedRank() {
      // Get the selected tier value
      const selectedTier = document.querySelector('input[name="start_tier"]:checked').value;
  
      // Get the selected division value
      const selectedDivision = document.querySelector('input[name="start_division"]:checked').value;
  
      // Map the tier and division values to their respective labels
      const tierLabels = {
        "1": "Iron",
        "2": "Bronze",
        "3": "Silver",
        "4": "Gold",
        "5": "Platinum",
        "6": "Diamond",
        "7": "Ascendant",
        "8": "Immortal"
      };
  
      // Concatenate the tier label and division value
      const selectedRank = tierLabels[selectedTier] + " " + selectedDivision;
  
      // Update the text of the <p> element
      const selectedRankElement = document.getElementById("sum_start_rank");
      selectedRankElement.innerHTML = selectedRank;
  
      // Update the image source
      const startRankImg = document.getElementById('start_rank_img');
      const startRankImg1 = document.getElementById('sum_start_rank_img');
      const rankImgSrc = `img/boost/${selectedTier}${selectedDivision}.png`;
      startRankImg.src = rankImgSrc;
      startRankImg1.src = rankImgSrc;
  
      // Calculate the price after updating the selected rank
      calculatePrice();
    }
  
    // Add event listeners to tier and division inputs
    const tierInputs = document.querySelectorAll('input[name="start_tier"]');
    const divisionInputs = document.querySelectorAll('input[name="start_division"]');
    tierInputs.forEach(function(input) {
      input.addEventListener('change', updateSelectedRank);
    });
    divisionInputs.forEach(function(input) {
      input.addEventListener('change', updateSelectedRank);
    });
  
    // Call the function to initialize selected rank
    updateSelectedRank();
  
    // Function to update the desired rank image and text
    function updateDesiredRank() {
      // Get the selected tier and division values
      const selectedTier = document.querySelector('input[name="desired_tier"]:checked').value;
      let selectedDivision = document.querySelector('input[name="desired_division"]:checked').value;
  
      // Check if the desired tier is Radiant
      if (selectedTier === "9") {
        // Disable all division inputs
        const divisionInputs = document.querySelectorAll('input[name="desired_division"]');
        divisionInputs.forEach(function(input) {
          input.disabled = true;
        });
  
        // Set the selected division to 0 (not applicable)
        selectedDivision = "0";
      } else {
        // Enable all division inputs
        const divisionInputs = document.querySelectorAll('input[name="desired_division"]');
        divisionInputs.forEach(function(input) {
          input.disabled = false;
        });
      }
  
      // Set the image source based on the selected tier and division
      const desiredRankImg = document.getElementById('end_rank_img');
      const desiredRankImg1 = document.getElementById('sum_end_rank_img');
      const rankImgSrc = `img/boost/${selectedTier}${selectedDivision}.png`;
      desiredRankImg.src = rankImgSrc;
      desiredRankImg1.src = rankImgSrc;
  
      // Set the text of the <p> element
      const desiredRankText = document.getElementById('sum_end_rank');
      const tierLabels = {
        "1": "Iron",
        "2": "Bronze",
        "3": "Silver",
        "4": "Gold",
        "5": "Platinum",
        "6": "Diamond",
        "7": "Ascendant",
        "8": "Immortal",
        "9": "Radiant",
      };
      let selectedRank = tierLabels[selectedTier];
      if (selectedDivision !== "0") {
        selectedRank += " " + selectedDivision;
      }
      desiredRankText.innerHTML = selectedRank;
  
      // Calculate the price after updating the desired rank
      calculatePrice();
    }
  
    // Add event listeners to tier and division inputs
    const desiredTierInputs = document.querySelectorAll('input[name="desired_tier"]');
    const desiredDivisionInputs = document.querySelectorAll('input[name="desired_division"]');
    const serverInputs = document.querySelectorAll('input[name="selected_server"]');
    desiredTierInputs.forEach(function(input) {
      input.addEventListener('change', updateDesiredRank);
    });
    desiredDivisionInputs.forEach(function(input) {
      input.addEventListener('change', updateDesiredRank);
    });
  
    // Call the function to initialize desired rank image and text
    updateDesiredRank();
  
    // Assign the rank boost data to a JavaScript variable
    rankBoosts = @json($rankboosts);
  
    // Function to calculate the price based on the selected ranks and server
    function calculatePrice() {
  // Get the current and desired ranks
  const currentTier = parseInt(document.querySelector('input[name="start_tier"]:checked').value);
  const currentDivision = parseInt(document.querySelector('input[name="start_division"]:checked').value);
  const desiredTier = parseInt(document.querySelector('input[name="desired_tier"]:checked').value);
  const desiredDivision = parseInt(document.querySelector('input[name="desired_division"]:checked').value);
 
  // Check if the desired rank is higher than the current rank
  if (desiredTier * 10 + desiredDivision > currentTier * 10 + currentDivision) {
    // Valid rank boost

    // Enable the Buy Boost Now button
    const buyButton = document.getElementById('buy_boost_button');
    buyButton.disabled = false;
    buyButton.textContent = 'Buy Boost Now';
    const requestBody = {

    // Prepare the request payload
    
      currentTier: currentTier,
      currentDivision: currentDivision,
      desiredTier: desiredTier,
      desiredDivision: desiredDivision,
      selectedRR: document.getElementById('current_rr').value.trim(),
      Play_w_booster: document.getElementById('is_duo').checked ? '1' : '0',
      is_priority: document.getElementById('priority').checked ? '1' : '0',
      // Include any other relevant data you need to send
    };

    // Get the CSRF token from the page
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    // Send the AJAX request to the server-side endpoint
    // Fetch the price and update the UI
fetch('/calculate-price', {
  method: 'POST',
  headers: {
    'Content-Type': 'application/json',
    'X-CSRF-TOKEN': csrfToken, // Include the CSRF token in the headers
  },
  body: JSON.stringify(requestBody),
})
.then(response => response.json())
.then(data => {
  // Log the response data for debugging
  // Handle the response
  const totalPrice = parseFloat(data.totalPrice);
  // Update the UI with the retrieved price
  document.getElementById('price_total').textContent = totalPrice.toFixed(2);
  document.getElementById('total_price').value = totalPrice.toFixed(2);
  document.getElementById('buy_boost_button').disabled = false;
})
.catch(error => {
  // Log the error for debugging
  console.error('Error calculating price:', error);
  // Update the UI to display an error message
  document.getElementById('price_total').textContent = 'Error';
  document.getElementById('buy_boost_button').disabled = true;
});
  } else {
    // Invalid rank boost

    // Disable the Buy Boost Now button and display an error message
    const buyButton = document.getElementById('buy_boost_button');
    buyButton.disabled = true;
    buyButton.textContent = 'Invalid data';

    // Reset the price to 0.00
    const priceElement = document.getElementById('price_total');
    priceElement.textContent = '0.00';
  }
}


    const currentRRSelect = document.getElementById('current_rr');
currentRRSelect.addEventListener('change', calculatePrice);
  // Add event listeners to the checkboxes
const playWithBoosterCheckbox = document.getElementById('is_duo');
playWithBoosterCheckbox.addEventListener('change', calculatePrice);

const priorityBoostCheckbox = document.getElementById('priority');
priorityBoostCheckbox.addEventListener('change', calculatePrice);
const currentRankElement = document.getElementById('sum_start_rank');
  const desiredRankElement = document.getElementById('sum_end_rank');
  const currentRank = currentRankElement.textContent.trim();
  const desiredRank = desiredRankElement.textContent.trim();

  // Get the selected server from the hidden input
  const selectedServerElement = document.getElementById('start_lp');
  const selectedServer = selectedServerElement.value.trim();
  const selectedRR =  document.getElementById('current_rr').value.trim();

  // Set the values of the hidden fields
  
document.getElementById('current_rank').value = currentRank;
document.getElementById('desired_rank').value = desiredRank;
document.getElementById('Server').value = selectedServer;
document.getElementById('current_rr1').value = selectedRR; // Set the value accordingly


    function buyBoost() {
      // Get the current and desired ranks
      const currentRankElement = document.getElementById('sum_start_rank');
  const desiredRankElement = document.getElementById('sum_end_rank');
  const currentRank = currentRankElement.textContent.trim();
  const desiredRank = desiredRankElement.textContent.trim();

  // Get the selected server from the hidden input
  const selectedServerElement = document.getElementById('start_lp');
  const selectedServer = selectedServerElement.value.trim();

  // Set the values of the hidden fields
  const priceTotalElement = document.getElementById('price_total');
const totalPriceValue = priceTotalElement.textContent;

// Set the value of total_price input
  document.getElementById('p_with_booster').value = document.getElementById('is_duo').checked ? '1' : '0';
document.getElementById('is_priority').value = document.getElementById('priority').checked ? '1' : '0';
document.getElementById('current_rank').value = currentRank;
document.getElementById('desired_rank').value = desiredRank;
document.getElementById('Server').value = selectedServer;
document.getElementById('current_rr1').value =document.getElementById('current_rr').value.trim(); // Set the value accordingly

    }
    document.getElementById('buy_boost_button').addEventListener('click', buyBoost);

  </script>
  <script>
    const agentsCheckbox = document.getElementById('agents');
    const agentsModal = new bootstrap.Modal(document.getElementById('agents-modal'));

    agentsCheckbox.addEventListener('change', function() {
        if (agentsCheckbox.checked) {
            agentsModal.show();
        } else {
            agentsModal.hide();
        }
    });

   
</script>
<script>
// JavaScript code
document.addEventListener('DOMContentLoaded', function() {
  const plusButton = document.querySelector('.ss-multi-selected');
  const content = document.querySelector('.ss-content');
  const agentOptions = document.querySelectorAll('.ss-option');
  const spAgentsInput = document.getElementById('sp_agent');
  let selectedAgents = []; // Array to store the selected agents

  plusButton.addEventListener('click', function() {
    content.classList.toggle('ss-open');
  });

  agentOptions.forEach(function(option) {
    option.addEventListener('click', function() {
      if (!this.classList.contains('ss-disabled')) {
        this.classList.add('ss-disabled');
        const selectedValue = this.textContent;
        addSelectedAgent(selectedValue);
      }
    });
  });

  document.addEventListener('click', function(event) {
    const targetElement = event.target;
    if (!content.contains(targetElement) && !plusButton.contains(targetElement)) {
      content.classList.remove('ss-open');
    }
  });

  function addSelectedAgent(value) {
    const valuesContainer = document.querySelector('.ss-values');
    const selectedAgent = document.createElement('div');
    selectedAgent.classList.add('ss-value');
    selectedAgent.innerHTML = value;
    selectedAgent.value=value;
    const deleteButton = document.createElement('span');
    deleteButton.classList.add('ss-value-delete');
    deleteButton.innerHTML = 'x';
    deleteButton.addEventListener('click', function() {
      deleteSelectedAgent(selectedAgent);
    });
    selectedAgent.appendChild(deleteButton);
    valuesContainer.appendChild(selectedAgent);
    selectedAgents.push(value); // Add selected agent to the array
    updateAgentsInput();
  }
  function deleteSelectedAgent(selectedAgent) {
  const value = selectedAgent.value;
  console.log(value);
  const option = Array.from(agentOptions).find(function(option) {
    return option.value === value;
  });
  if (option) {
    option.disabled = false;
    option.classList.remove('ss-disabled');
  }
  selectedAgent.remove();
  selectedAgents = selectedAgents.filter(function(agent) {
    return agent !== value;
  });
  updateAgentsInput();
  agentOptions.forEach(function(option) {
    if (option.textContent === value){
      option.classList.remove('ss-disabled');
    }
    
  });
}



function updateAgentsInput() {
  const spAgentsInput = document.getElementById('sp_agent');
  spAgentsInput.value = selectedAgents.join(', ');
  console.log(spAgentsInput.value);
 

}
});


</script>

@endsection
