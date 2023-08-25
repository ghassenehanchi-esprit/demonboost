@extends('base2')

@section('content')


<form action="{{ route('smurf-accounts.store') }}" method="POST">
    @csrf

    <div class="form-group">
        <label for="type">Account Type:</label>
        <select name="type" id="type" class="form-control">
            <option value="Basic">Basic</option>
            <option value="Starter">Starter</option>
            <option value="Prime">Prime</option>
            <option value="Supreme">Supreme</option>
            <option value="Ultimate">Ultimate</option>
        </select>
    </div>
    <div class="form-group">
        <label for="server">Server:</label>
        <select name="server" id="server" class="form-control">
            <option value="Europe">Europe</option>
            <option value="Oceania">Oceania</option>
            <option value="Brazil">Brazil</option>
            <option value="North America">North America</option>
            <option value="Southeast Asia">Southeast Asia</option>
        </select>
    </div>
    <div class="form-group">
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" class="form-control">
    </div>

    <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" class="form-control">
    </div>

    <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" class="form-control">
    </div>

    <div class="form-group">
        <label for="email_password">Email Password:</label>
        <input type="password" name="email_password" id="email_password" class="form-control">
    </div>

    <button type="submit" class="btn btn-primary">Add Account</button>
</form>


@endsection