@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Withdraw Earnings</div>

                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('earning.withdraw') }}">
                            @csrf

                            <div class="form-group">
                                <label for="earnings">Select Earnings to Withdraw:</label>
                                <select id="earnings" name="earnings[]" class="form-control" multiple required>
                                    @foreach ($earnings as $earning)
                                        <option value="{{ $earning->id }}">{{ $earning->amount }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="withdrawal_method">Select Withdrawal Method:</label>
                                <select id="withdrawal_method" name="withdrawal_method" class="form-control" required>
                                    <option value="paypal">PayPal</option>
                                    <option value="credit_card">Bank Transfer</option>
                                </select>
                            </div>

                            <div id="paypal_fields" style="display: block;">
                                <div class="form-group">
                                    <label for="paypal_email">PayPal Email:</label>
                                    <input type="email" id="paypal_email" name="paypal_email" class="form-control">
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">Withdraw</button>
                            <a href="{{ url('/') }}" class="btn btn-secondary">Back to Home</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('withdrawal_method').addEventListener('change', function () {
            var paypalFields = document.getElementById('paypal_fields');
            var creditCardFields = document.getElementById('credit_card_fields');

            if (this.value === 'paypal') {
                paypalFields.style.display = 'block';
                creditCardFields.style.display = 'none';
            } else if (this.value === 'credit_card') {
                paypalFields.style.display = 'none';
                creditCardFields.style.display = 'block';
            } else {
                paypalFields.style.display = 'none';
                creditCardFields.style.display = 'none';
            }
        });
    </script>
@endsection
