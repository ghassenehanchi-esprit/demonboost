@extends('layouts.app')

@section('content')
    <h1>Rank Boost Payment</h1>

    <!-- Include Stripe.js library -->
    <script src="https://js.stripe.com/v3/"></script>

    <!-- Create the payment form -->
    <form action="{{ route('process.payment') }}" method="POST" id="stripe-payment-form">
        @csrf
        <div class="form-group">
            <label for="card-element">Credit or debit card</label>
            <div id="card-element">
                <!-- A Stripe element will be inserted here -->
            </div>
            <div id="card-errors" role="alert"></div>
        </div>

        <button type="submit" class="btn btn-primary">Pay Now</button>
    </form>

    <!-- JavaScript to handle the Stripe payment form -->
    <script>
        // Create a Stripe client
        var stripe = Stripe('{{ config('services.stripe.key') }}');

        // Create an instance of Elements
        var elements = stripe.elements();

        // Create an instance of the card Element
        var card = elements.create('card');

        // Mount the card Element to the card-element div
        card.mount('#card-element');

        // Handle real-time validation errors from the card Element
        card.addEventListener('change', function(event) {
            var displayError = document.getElementById('card-errors');
            if (event.error) {
                displayError.textContent = event.error.message;
            } else {
                displayError.textContent = '';
            }
        });

        // Handle the form submission
        var form = document.getElementById('stripe-payment-form');
        form.addEventListener('submit', function(event) {
            event.preventDefault();

            // Disable the submit button to prevent multiple submissions
            var submitButton = form.querySelector('button');
            submitButton.disabled = true;

            // Create a payment token with the card details
            stripe.createToken(card).then(function(result) {
                if (result.error) {
                    // Inform the user if there was an error
                    var errorElement = document.getElementById('card-errors');
                    errorElement.textContent = result.error.message;

                    // Enable the submit button
                    submitButton.disabled = false;
                } else {
                    // Append the token ID to the form as a hidden input
                    var tokenInput = document.createElement('input');
                    tokenInput.type = 'hidden';
                    tokenInput.name = 'stripeToken';
                    tokenInput.value = result.token.id;
                    form.appendChild(tokenInput);

                    // Submit the form
                    form.submit();
                }
            });
        });
    </script>
@endsection
