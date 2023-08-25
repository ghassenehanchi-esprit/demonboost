@extends('base')

@section('title', 'Account Settings')

@section('content')

<div class="row py-5 px-4" style="margin-top: 200px;margin-right:100px;">
    <div class="col-md-3">
        <!-- Menu bar -->
        <div class="list-group">
            <a href="#account-settings" id="account-settings-link" class="list-group-item list-group-item-action {{ Request::segment(2) == 'settings' ? 'active' : '' }}">Account Settings</a>
            <a href="#security-settings" id="security-settings-link" class="list-group-item list-group-item-action {{ Request::segment(2) == 'security' ? 'active' : '' }}">Security Settings</a>
        </div>
    </div>
    <div class="col-md-9">
        <div class="bg-white shadow rounded overflow-hidden pt-5 pb-5">
            <div class="col-md-12 mb-4 ml-4">
                <p style="color: black;">Need to update your public profile? Go to <a href="{{ route('profile.show', ['id' => Auth::user()->profile->id]) }}">My Profile</a></p>
            </div>
            <hr style="margin-left: 50px;margin-right: 50px;">

            <div id="account-settings" class="col-md-6" style="{{ Request::segment(2) == 'settings' ? 'display: block;' : 'display: none;' }}">
                <h2>Account Settings</h2>
                <!-- Account settings form -->
                <form action="{{ route('account.update', ['id' => Auth::id()]) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <!-- Account settings fields -->
                    <div class="form-group">
                        <label for="firstName">First Name</label>
                        <input type="text" class="form-control" id="firstName" name="firstName" value="{{ old('firstName', Auth::user()->first_name) }}">
                    </div>
                    <div class="form-group">
                        <label for="lastName">Last Name</label>
                        <input type="text" class="form-control" id="lastName" name="lastName" value="{{ old('lastName', Auth::user()->last_name) }}">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ old('email', Auth::user()->email) }}">
                    </div>
                    <!-- Additional account settings fields -->

                    <!-- Save button -->
                    <button type="submit" class="btn btn-primary">Save Account Settings</button>
                </form>
            </div>
            <div id="security-settings" class="col-md-6" style="{{ Request::segment(2) == 'security' ? 'display: block;' : 'display: none;' }}">
                <h2>Security Settings</h2>
                <!-- Security settings form -->
                <form action="{{ route('security.update', ['id' => Auth::id()]) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <!-- Security settings fields -->
                    <div class="form-group">
                        <label for="currentPassword">Current Password</label>
                        <input type="password" class="form-control" id="currentPassword" name="currentPassword">
                    </div>
                    <div class="form-group">
                        <label for="newPassword">New Password</label>
                        <input type="password" class="form-control" id="newPassword" name="newPassword">
                    </div>
                    <!-- Additional security settings fields -->

                    <!-- Save button -->
                    <button type="submit" class="btn btn-primary">Save Security Settings</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Get the current URL
        var currentUrl = window.location.href;

        // Handle click on Account Settings link
        $('#account-settings-link').on('click', function(e) {
            e.preventDefault();
            $('#account-settings').show();
            $('#security-settings').hide();
            $(this).addClass('active');
            $('#security-settings-link').removeClass('active');
        });

        // Handle click on Security Settings link
        $('#security-settings-link').on('click', function(e) {
            e.preventDefault();
            $('#account-settings').hide();
            $('#security-settings').show();
            $(this).addClass('active');
            $('#account-settings-link').removeClass('active');
        });

        // Check the current URL and update the menu item accordingly
        if (currentUrl.includes('#security-settings')) {
            $('#security-settings').show();
            $('#security-settings-link').addClass('active');
            $('#account-settings-link').removeClass('active');
        } else {
            $('#account-settings').show();
            $('#account-settings-link').addClass('active');
            $('#security-settings-link').removeClass('active');
        }
    });
</script>

@endsection
