@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card p-4" style="max-width: 500px;">
                    <div class="card-body" style="margin-left: 50px; margin-right: 50px;">
                        <h2 class="card-title p-4"><strong>Access to your Purchased Account</strong></h2>
                        <div class="card-body text-center" style="margin-left: 50px; margin-right: 50px;">
                            @if (isset($accountCredentials))
                                <h5 class="p-2" style="font-size: 12px; color: grey;">Your Account Credentials:</h5>
                                <ul class="list-unstyled">
                                    @foreach ($accountCredentials as $key => $value)
                                        <li><strong>{{ $key }}:</strong> {{ $value }}</li>
                                    @endforeach
                                </ul>
                            @else
                                <h5 class="p-2" style="font-size: 12px; color: grey;">Please Enter the Account token to get the credentials</h5>
                                <!-- Display validation errors -->
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul class="mb-0">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <!-- Rest of the code -->
                            @endif
                        </div>

                        <form action="{{ route('account-order.success', ['id' => $account->valorantAccountOrder->id]) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="username">Account Token</label>
                                <input type="text" name="token" id="token" class="form-control" required>
                            </div>

                            <div class="mb-5">
                                <button type="submit" class="btn btn-primary btn-block w-100">Get my Account</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
