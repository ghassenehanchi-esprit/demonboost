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

                    <form action="{{ route('send-verification-notification') }}" method="POST">
                        @csrf
                    
                        <label for="username">Discord Username:</label>
                        <input type="text" id="username" name="username" class="form-control" required>
                        @error('username')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                        <label for="available_date">Available Date:</label>
                        <input type="date" id="available_date" name="available_date" class="form-control" required>
                    
                        <button type="submit" class="btn btn-primary btn-block w-100">Submit</button>
                    </form>
                    
                </div>
            </div>
            </div>
            </div>
            </div>

                    @endsection