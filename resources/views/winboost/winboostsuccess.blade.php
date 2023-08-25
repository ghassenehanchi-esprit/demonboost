@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card p-4" style="max-width: 500px;">
                <div class="card-body" style="margin-left: 50px; margin-right: 50px;">
                    <h2 class="card-title p-4"><strong>Client Area Login</strong></h2>
                    <div class="card-body text-center" style="margin-left: 50px; margin-right: 50px;">
                        <h5 class="p-2" style="font-size: 12px; color: grey;">Sign into your 1Datei client account.</h5>
                        <!-- Rest of the code -->
                    </div>


<form action="{{ route('win-boost-order.update', ['id' => $winBoostOrder->id]) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label for="username">Username</label>
        <input type="text" name="username" id="username" class="form-control" required>
    </div>

    @if ($winBoostOrder->p_with_booster == 0)
    <div class="mb-3">
        <label for="password">Password</label>
        <input type="password" name="password" id="password" class="form-control" required>
    </div>
    @endif
    <div class="mb-5 ">
    <button type="submit" class="btn btn-primary btn-block w-100">Send Valorant Details</button>
</div>
</form>

</div>
</div>
</div>
</div>
</div>
</div>
@endsection