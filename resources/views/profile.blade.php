@extends('base')

@section('title', 'Profile')

@section('content')

<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="row py-5 px-4" style="margin-top:200px;">
    <div class="col-md-1">
        <!-- Menu bar -->
       
    </div>
    <div class="col-md-9">
        <div class="bg-white shadow rounded overflow-hidden pt-5 pb-5">
            <div class="px-4 pt-0 pb-4 cover">
                <!-- Avatar form -->
                <form id="avatarForm" action="{{ route('profile.updateAvatar') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Avatar field -->
                    <div class="form-group">
                        <div class="d-flex align-items-center">
                            <div class="mr-3">
                                <img id="avatarPreview" src="{{ asset('img/'.$profile->avatar) }}" alt="Avatar" width="130" class="rounded mb-2 img-thumbnail">
                            </div>
                            <div>
                                <input type="file" class="form-control" id="avatar" name="avatar" style="display: none;">
                                <button type="button" id="editAvatar" class="btn btn-outline-primary btn-sm">Edit</button>
                                <button type="button" id="cancelAvatar" class="btn btn-outline-secondary btn-sm" style="display: none;">Cancel</button>
                            </div>
                        </div>
                    </div>

                    <!-- Submit button -->
                    <button type="submit" id="saveAvatar" class="btn btn-primary" style="display: none;">Save</button>
                </form>

                <!-- User's name -->
                <h5 style="color: black;">{{ $profile->user->first_name }} {{ $profile->user->last_name }}</h5>

                <!-- Account settings button -->
                <a href="{{ route('settings', ['id' => auth()->id()]) }}">Account Settings</a>

                <!-- Add accounts button (if is_seller is 1) -->
              
            </div>
            <div class="px-4 py-3">
            @if ($profile->is_seller)
            <a href="{{ route('add.account') }}" class="btn btn-primary">Add Accounts For Sale</a>
            
        @endif
    </div>
            <div class="px-4 py-3">
                <div class="form-group mb-0">
                    <label for="bio">Bio</label>
                    <div class="d-flex align-items-center">
                        <div class="mr-3">
                            <p id="bioText" class="mb-0" style="color: black; word-break: break-word;">{{ $profile->bio }}</p>
                            <textarea id="bio" name="bio" class="form-control" style="display: none;">{{ $profile->bio }}</textarea>
                        </div>
                        <div>
                            <button type="button" id="editBio" class="btn btn-outline-primary btn-sm">Edit</button>
                            <button type="button" id="cancelBio" class="btn btn-outline-secondary btn-sm" style="display: none;">Cancel</button>
                        </div>
                    </div>
                </div>

                <!-- Submit button -->
                <button type="button" id="saveBio" class="btn btn-primary" style="display: none;">Save</button>
            </div>
        </div>
    </div>
    @if ($withdrawalAmount > 0)
<div class="col-md-2">
    <div class="bg-white shadow rounded overflow-hidden pt-5 pb-5">
        <div class="px-4 pt-0 pb-4">
            <h5 style="color: black;">Withdrawal Amount</h5>
            <a href="{{ route('earning.withdrawForm') }}" class="btn btn-success">{{ $withdrawalAmount }}</a>
        </div>
    </div>
</div>
@endif
</div>


<script>
    // Edit avatar
    const editAvatarButton = document.getElementById('editAvatar');
    const cancelAvatarButton = document.getElementById('cancelAvatar');
    const saveAvatarButton = document.getElementById('saveAvatar');
    const avatarInput = document.getElementById('avatar');
    const avatarPreview = document.getElementById('avatarPreview');
    const avatarForm = document.getElementById('avatarForm');

    editAvatarButton.addEventListener('click', () => {
        editAvatarButton.style.display = 'none';
        cancelAvatarButton.style.display = 'inline-block';
        saveAvatarButton.style.display = 'inline-block';
        avatarInput.style.display = 'block';
        avatarPreview.style.display = 'none';
    });

    cancelAvatarButton.addEventListener('click', () => {
        editAvatarButton.style.display = 'inline-block';
        cancelAvatarButton.style.display = 'none';
        saveAvatarButton.style.display = 'none';
        avatarInput.style.display = 'none';
        avatarPreview.style.display = 'block';
    });

    avatarInput.addEventListener('change', () => {
        const reader = new FileReader();
        reader.onload = function (e) {
            avatarPreview.src = e.target.result;
        };
        reader.readAsDataURL(avatarInput.files[0]);
    });

    // Edit bio
    const editBioButton = document.getElementById('editBio');
    const cancelBioButton = document.getElementById('cancelBio');
    const saveBioButton = document.getElementById('saveBio');
    const bioText = document.getElementById('bioText');
    const bioTextarea = document.getElementById('bio');

    editBioButton.addEventListener('click', () => {
        editBioButton.style.display = 'none';
        cancelBioButton.style.display = 'inline-block';
        saveBioButton.style.display = 'inline-block';
        bioText.style.display = 'none';
        bioTextarea.style.display = 'block';
    });

    cancelBioButton.addEventListener('click', () => {
        editBioButton.style.display = 'inline-block';
        cancelBioButton.style.display = 'none';
        saveBioButton.style.display = 'none';
        bioText.style.display = 'block';
        bioTextarea.style.display = 'none';
    });

    saveBioButton.addEventListener('click', () => {
        const bio = bioTextarea.value;
        const profileId = '{{ $profile->id }}'; // Replace with the actual profile ID

        // Get the CSRF token value from the page's meta tag
        const csrfTokenElement = document.querySelector('meta[name="csrf-token"]');
        if (csrfTokenElement) {
            const csrfToken = csrfTokenElement.getAttribute('content');

            // Make an AJAX request to update the bio on the server
            const request = new XMLHttpRequest();
            request.open('PUT', '{{ route('profile.updateBio', ['id' => ':id']) }}'.replace(':id', profileId), true);
            request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
            request.setRequestHeader('X-CSRF-TOKEN', csrfToken); // Set the CSRF token header
            request.onreadystatechange = function () {
                if (request.readyState === XMLHttpRequest.DONE && request.status === 200) {
                    // Update the bio text on the page
                    bioText.textContent = bio;
                    editBioButton.style.display = 'inline-block';
                    cancelBioButton.style.display = 'none';
                    saveBioButton.style.display = 'none';
                    bioText.style.display = 'block';
                    bioTextarea.style.display = 'none';
                }
            };
            request.send('bio=' + encodeURIComponent(bio));
        } else {
            console.error('CSRF token meta tag not found');
        }
    });
</script>
@endsection
