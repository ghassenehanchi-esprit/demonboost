@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card p-4" style="max-width: 500px;">
                    <div class="card-body">
                        <h2 class="card-title">Access to your Purchased Account</h2>
                        <div class="card-body">
                            <h5 class="p-2" style="font-size: 12px; color: grey;">Your Account Credentials:</h5>
                            <ul>
                                @foreach ($accountCredentials as $key => $value)
                                    <li><strong>{{ $key }}:</strong> {{ $value }}</li>
                                @endforeach

                                @if (!$accountCredentials['Full Access'])
                                    <li>
                                        <strong>Discord Username:</strong>
                                        <form method="POST" action="{{ route('account.submitDiscordUsername', ['accountId' => $account->id]) }}">
                                            
                                            @csrf
                                            <input type="text" name="discord_username" required>
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </form>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
