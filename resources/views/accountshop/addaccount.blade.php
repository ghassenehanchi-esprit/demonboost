@extends('layouts.app')

@section('title', 'Add Account')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        
   
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Add Account') }}</div>

                <div class="card-body">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                    <form method="POST" action="{{ route('save.account') }}"enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row mb-4">
                            <label for="server" class="col-md-4 col-form-label text-md-right">{{ __('Server') }}</label>
                            <div class="col-md-6">
                                <select id="server" class="form-control @error('server') is-invalid @enderror" name="server" required>
                                    <option value="">Select Server</option>
                                    <option value="Europe">Europe</option>
                                    <option value="North America">North America</option>
                                    <option value="Oceania">Oceania</option>
                                    <option value="Brazil">Brazil</option>
                                    <option value="Southeast Asia">Southeast Asia</option>
                                </select>
                                @error('server')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        

                        <div class="form-group row mb-4">
                            <label for="rank" class="col-md-4 col-form-label text-md-right">{{ __('Rank') }}</label>

                            <div class="col-md-6">
                                <select id="rank" class="form-control @error('rank') is-invalid @enderror" name="rank" required>
                                    <option value="">Select Rank</option>
                                    <optgroup label="Iron">
                                        <option value="Iron 1">Iron 1</option>
                                        <option value="Iron 2">Iron 2</option>
                                        <option value="Iron 3">Iron 3</option>
                                    </optgroup>
                                    <optgroup label="Bronze">
                                        <option value="Bronze 1">Bronze 1</option>
                                        <option value="Bronze 2">Bronze 2</option>
                                        <option value="Bronze 3">Bronze 3</option>
                                    </optgroup>
                                    <optgroup label="Silver">
                                        <option value="Silver 1">Silver 1</option>
                                        <option value="Silver 2">Silver 2</option>
                                        <option value="Silver 3">Silver 3</option>
                                    </optgroup>
                                    <optgroup label="Gold">
                                        <option value="Gold 1">Gold 1</option>
                                        <option value="Gold 2">Gold 2</option>
                                        <option value="Gold 3">Gold 3</option>
                                    </optgroup>
                                    <optgroup label="Platinum">
                                        <option value="Platinum 1">Platinum 1</option>
                                        <option value="Platinum 2">Platinum 2</option>
                                        <option value="Platinum 3">Platinum 3</option>
                                    </optgroup>
                                    <optgroup label="Diamond">
                                        <option value="Diamond 1">Diamond 1</option>
                                        <option value="Diamond 2">Diamond 2</option>
                                        <option value="Diamond 3">Diamond 3</option>
                                    </optgroup>
                                    <optgroup label="Ascendant">
                                        <option value="Ascendant 1">Ascendant 1</option>
                                        <option value="Ascendant 2">Ascendant 2</option>
                                        <option value="Ascendant 3">Ascendant 3</option>
                                    </optgroup>
                                    <optgroup label="Immortal">
                                        <option value="Immortal 1">Immortal 1</option>
                                        <option value="Immortal 2">Immortal 2</option>
                                        <option value="Immortal 3">Immortal 3</option>
                                    </optgroup>
                                    <optgroup label="Radiant">
                                        <option value="Radiant">Radiant</option>
                                    </optgroup>
                                </select>

                                @error('rank')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-4">
                            <label for="level" class="col-md-4 col-form-label text-md-right">{{ __('Level') }}</label>

                            <div class="col-md-6">
                                <input id="level" type="number" class="form-control @error('level') is-invalid @enderror" name="level" value="{{ old('level') }}" required autocomplete="level">

                                @error('level')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-4">
                            <label for="level_method" class="col-md-4 col-form-label text-md-right">{{ __('Level Method') }}</label>

                            <div class="col-md-6">
                                <select id="level_method" class="form-control @error('level_method') is-invalid @enderror" name="level_method" required>
                                    <option value="">Select Level Method</option>
                                    <option value="Bot">Bot</option>
                                    <option value="Hand Leveled">Hand Leveled</option>
                                </select>

                                @error('level_method')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-4">
                            <label for="skins" class="col-md-4 col-form-label text-md-right">{{ __('Number of Skins') }}</label>

                            <div class="col-md-6">
                                <input id="skins" type="number" class="form-control @error('skins') is-invalid @enderror" name="skins" value="{{ old('skins') }}" required autocomplete="skins">

                                @error('skins')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-4">
                            <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>

                            <div class="col-md-6">
                                <textarea id="description" class="form-control @error('description') is-invalid @enderror" name="description" rows="3" required>{{ old('description') }}</textarea>

                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-4">
                            <label for="price" class="col-md-4 col-form-label text-md-right">{{ __('Price') }}</label>

                            <div class="col-md-6">
                                <input id="price" type="number" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ old('price') }}" required autocomplete="price">

                                @error('price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-4">
                            <label for="username" class="col-md-4 col-form-label text-md-right">{{ __('Username') }}</label>

                            <div class="col-md-6">
                                <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username">

                                @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-4">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-4">
                            <label for="full_access" class="col-md-4 col-form-label text-md-right">{{ __('Full Access') }}</label>

                            <div class="col-md-6">
                                <label class="switch s-icons s-outline s-outline-primary d-inline-block">
                                    <input id="full_access" type="checkbox"  name="full_access" value="1" {{ old('full_access') ? 'checked' : '' }}>
                                    <span class="slider round"></span>
                                  </label>
                                @error('full_access')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div id="email_fields" style="display: none;">
                            <div class="form-group row mb-4">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Email') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-4">
                                <label for="email_password" class="col-md-4 col-form-label text-md-right">{{ __('Email Password') }}</label>

                                <div class="col-md-6">
                                    <input id="email_password" type="password" class="form-control @error('email_password') is-invalid @enderror" name="email_password" autocomplete="new-email-password">

                                    @error('email_password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-4">
                            <label for="gallery" class="col-md-4 col-form-label text-md-right">{{ __('Gallery Photos') }}</label>
                        
                            <div class="col-md-6">
                                <input id="gallery" type="file" class="form-control @error('gallery') is-invalid @enderror" name="gallery[]" multiple accept="image/*">
                        
                                @error('gallery')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-4">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Save Account') }}
                                </button>
                            </div>
                        </div>
                       
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    document.addEventListener('DOMContentLoaded', function () {
        const fullAccessCheckbox = document.getElementById('full_access');
        const emailFields = document.getElementById('email_fields');

        fullAccessCheckbox.addEventListener('change', function () {
            emailFields.style.display = this.checked ? 'block' : 'none';
        });

        // Trigger the change event on page load if the checkbox is already checked
        if (fullAccessCheckbox.checked) {
            emailFields.style.display = 'block';
        }
    });
</script>
@endsection
