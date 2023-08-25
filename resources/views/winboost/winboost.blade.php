@extends('base')

@section('title', 'Win Boost')

@section('content')

<meta name="csrf-token" content="{{ csrf_token() }}">
<section class="about_us section_padding">
  <div class="container">
      <div class="row align-items-center justify-content-between">
          <div class="col-md-5 col-lg-6 col-xl-6">
              <div class="learning_img">
                  <img src="{{ asset('img/des.png') }}" alt=""style="max-height:400px;">
              </div>
          </div>
          <div class="col-md-5 col-lg-6 col-xl-5">
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
      <form action="{{ route('win.boost.order') }}" method="POST" id="val_boost_form" class="boost-form" autocomplete="off">
        @csrf


        <div class="row">
          <div class="col-lg-7 text-start navigation">
           
            <input type="text" id="total_price" name="total_price" value="" hidden="">
            <input type="text" id="p_with_booster" name="p_with_booster" value="" hidden="">
            <input type="text" id="is_priority" name="is_priority" value="" hidden="">
            <input type="text" id="sp_agent" name="sp_agent" value="" hidden="">
            <input type="text" id="selected_rank" name="selected_rank" value="" hidden="">
            <input type="text" id="match_number" name="match_number" value="" hidden="">
            <input type="text" id="Server" name="Server" value="" hidden="">
            
     
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
        <div class="card card-border-start border-gold mt-5" id="end_card">
            <div class="card-body">
            <div class="d-md-flex align-items-center gap-4 d-block text-start">
            <div class="h-13 d-flex align-items-center" width="100px">
            <output class="games-amount-display matches_display text-md-center text-primary text-start">1</output>
            </div>
            <div>
            <h5 class="card-title display-5 mb-0" style="color: black;">Matches Amount</h5>
            <p class="card-text d-md-block d-none"style="color: black;">Please set your desired amount of matches.</p>
            </div>
            </div>
            
            <div class="row mt-5">
                <div class="col-12">
                    <input type="range" name="matches" id="matches" class="" value="1" min="1" max="5" step="1" style="position: absolute; width: 1px; height: 1px; overflow: hidden; opacity: 0;">                    <div class="rangeslider rangeslider--horizontal" id="js-rangeslider-0">
                        <div class="rangeslider__fill"></div>
                        <div class="rangeslider__handle"></div>
                    </div>
                
                
                
            </div>
            </div>
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
                    <output id="sum_matches" class="text-center games-amount-display text-primary">1</output>
                    </div>
                    <p class="selected-rank mb-0" style="text-transform:capitalize;" id="sum_end_rank">Games</p>
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
                  <h3 class="mb-1 d-flex gap-2" style="color: black;">Pick Agents <span class="badge bg-pale-green text-green rounded lh-xxs">FREE</span></h3>
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
                <button name="submit" type="submit" class="btn btn-primary btn-lg rounded"id="buy_boost_button">
                  <span class="indicator-label">Buy Boost Now</span>
                </button>
              </div>
              
            </div>
          </div>
        </div>
        
    </div>
      </form>
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
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <script>
    // Range Slider Script
    var rangeSlider = document.getElementById("js-rangeslider-0");
    var inputField = document.getElementById("matches");
    var fill = rangeSlider.querySelector(".rangeslider__fill");
    var handle = rangeSlider.querySelector(".rangeslider__handle");

    var positions = [1, 2, 3, 4, 5];
    var width = rangeSlider.offsetWidth;
    var stepWidth = width / (positions.length - 1);

    rangeSlider.addEventListener("mousedown", function(event) {
        var rangeRect = rangeSlider.getBoundingClientRect();
        var offsetX = event.clientX - rangeRect.left;
        var position = Math.round(offsetX / stepWidth);

        if (position < 0) {
            position = 0;
        } else if (position >= positions.length) {
            position = positions.length - 1;
        }

        var value = positions[position];

        fill.style.width = (position * stepWidth) + "px";
        handle.style.left = (position * stepWidth) + "px";

        inputField.value = value;

        updateElements(value); // Call the function to update the elements

        document.addEventListener("mousemove", handleDrag);
        document.addEventListener("mouseup", handleRelease);
    });

    function handleDrag(event) {
        var rangeRect = rangeSlider.getBoundingClientRect();
        var offsetX = event.clientX - rangeRect.left;
        var position = Math.round(offsetX / stepWidth);

        if (position < 0) {
            position = 0;
        } else if (position >= positions.length) {
            position = positions.length - 1;
        }

        var value = positions[position];

        fill.style.width = (position * stepWidth) + "px";
        handle.style.left = (position * stepWidth) + "px";

        inputField.value = value;

        updateElements(value); // Call the function to update the elements
    }

    function handleRelease() {
        document.removeEventListener("mousemove", handleDrag);
        document.removeEventListener("mouseup", handleRelease);
    }

    // Rank Update Script
    function updateSelectedRank() {
        // Get the selected tier value
        const selectedTier = document.querySelector('input[name="start_tier"]:checked').value;

        // Get the selected division value
        let selectedDivision = document.querySelector('input[name="start_division"]:checked').value;

        // Map the tier and division values to their respective labels
        const tierLabels = {
            "0": "Unranked",
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

        if (selectedTier === "9" || selectedTier === "0") {
            // Disable all division inputs
            const divisionInputs = document.querySelectorAll('input[name="start_division"]');
            divisionInputs.forEach(function(input) {
                input.disabled = true;
            });

            // Set the selected division to 0 (not applicable)
            selectedDivision = "0";
        } else {
            // Enable all division inputs
            const divisionInputs = document.querySelectorAll('input[name="start_division"]');
            divisionInputs.forEach(function(input) {
                input.disabled = false;
            });
        }

        // Concatenate the tier label and division value
        let selectedRank = tierLabels[selectedTier];
        if (selectedDivision !== "0") {
            selectedRank += selectedDivision;
        }
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

        // Set the value of the hidden input field
        const selectedRankInput = document.getElementById('selected_rank');
        selectedRankInput.value = selectedRank;
    }

    const tierInputs = document.querySelectorAll('input[name="start_tier"]');
    const divisionInputs = document.querySelectorAll('input[name="start_division"]');
    tierInputs.forEach(function(input) {
        input.addEventListener('change', updateSelectedRank);
    });
    divisionInputs.forEach(function(input) {
        input.addEventListener('change', updateSelectedRank);
    });

    // Function to update the elements
    function updateElements(value) {
        var gamesAmountDisplay = document.querySelector(".games-amount-display.matches_display");
        var sumMatches = document.getElementById("sum_matches");

        gamesAmountDisplay.textContent = value;
        sumMatches.textContent = value;

        // Call the function to update the price
        updateSelectedRank();
    }

    // Event listener for input event on range slider
    rangeSlider.addEventListener("input", function() {
        calculatePrice();
        var position = parseInt(inputField.value);

        if (position < positions[0]) {
            position = positions[0];
        } else if (position > positions[positions.length - 1]) {
            position = positions[positions.length - 1];
        }

        var index = positions.indexOf(position);
        var leftPosition = index * stepWidth;

        fill.style.width = leftPosition + "px";
        handle.style.left = leftPosition + "px";

        inputField.value = position;

        updateElements(position); // Call the function to update the elements
    });

    // Initial update of the elements
    updateElements(positions[0]);

    function calculatePrice() {
  const placementBoosts = @json($winboosts); // Assuming placementBoosts is a JavaScript array containing the placement boost data
  const numberOfGames = parseInt(document.getElementById("sum_matches").textContent.trim(), 10);
  const playWithBoosterCheckbox = document.getElementById('is_duo');
  const priorityBoostCheckbox = document.getElementById('priority');
  const selectedTier = document.querySelector('input[name="start_tier"]:checked').value;

// Get the selected division value

// Map the tier and division values to their respective labels
const tierLabels = {
  
    "1": "Iron",
    "2": "Bronze",
    "3": "Silver",
    "4": "Gold",
    "5": "Platinum",
    "6": "Diamond",
    "7": "Ascendant",
    "8": "Immortal",
   
};

let selectedDivision = document.querySelector('input[name="start_division"]:checked').value;

let selectedRank = tierLabels[selectedTier];

if (selectedDivision !== "0") {
            selectedRank += selectedDivision;
        }
  // Prepare the request body
  const requestBody = {
    selectedRank,
    numberOfGames,
    Play_w_booster: document.getElementById('is_duo').checked ? '1' : '0',
      is_priority: document.getElementById('priority').checked ? '1' : '0',
  };
  const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

  // Send the Ajax request
  fetch('/calculate-price-win', {
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

      // Handle the response
      const totalPrice = parseFloat(data.totalPrice);
      if (totalPrice) {
        const buyButton = document.getElementById('buy_boost_button');
        buyButton.disabled = false;
        buyButton.textContent = 'Buy Boost Now';
        const totalPrice = parseFloat(data.totalPrice);
  // Update the UI with the retrieved price
  document.getElementById('price_total').textContent = totalPrice.toFixed(2);
  document.getElementById('total_price').value = totalPrice.toFixed(2);
  document.getElementById('buy_boost_button').disabled = false;
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
    })
    .catch(error => {
      // Log the error for debugging
      console.error('Error calculating price:', error);
      // Update the UI to display an error message
      const buyButton = document.getElementById('buy_boost_button');
      buyButton.disabled = true;
      buyButton.textContent = 'Error';

      // Reset the price to 0.00
      const priceElement = document.getElementById('price_total');
      priceElement.textContent = '0.00';
    });
}

const playWithBoosterCheckbox = document.getElementById('is_duo');
playWithBoosterCheckbox.addEventListener('change', calculatePrice);

const priorityBoostCheckbox = document.getElementById('priority');
priorityBoostCheckbox.addEventListener('change', calculatePrice);
    function buyBoost() {
      // Get the current and desired ranks
      const currentRankElement = document.getElementById('sum_start_rank');
  const currentRank = currentRankElement.textContent.trim();

  // Get the selected server from the hidden input
  const selectedServerElement = document.getElementById('start_lp');
  const selectedServer = selectedServerElement.value.trim();

  // Set the values of the hidden fields
 
const selectedMatchNumber = parseInt(document.getElementById('matches').value);

// Set the value of total_price input
  document.getElementById('p_with_booster').value = document.getElementById('is_duo').checked ? '1' : '0';
document.getElementById('is_priority').value = document.getElementById('priority').checked ? '1' : '0';
document.getElementById('selected_rank').value = currentRank;
document.getElementById('Server').value = selectedServer;
document.getElementById('match_number').value=selectedMatchNumber;
    }

    calculatePrice();
    document.getElementById('buy_boost_button').addEventListener('click', buyBoost);
    console.log(document.getElementById('price_total').textContent);
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

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