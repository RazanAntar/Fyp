@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8">
            
             <!-- Profile Header -->
             <div class="text-center mb-3">
                <h3 class="fw-bold" style="color: #502159;">{{ __('Profile Settings') }}</h3>
                <p class="text-muted small">Manage your personal details, change your password, or delete your account.</p>
            </div>

            <!-- Profile Information Form -->
            <div class="card border-0 shadow-sm mb-3">
                <div class="card-header" style="background-color: #502159; color: white; font-weight: bold; font-size: 14px;">
                    {{ __('Profile Information') }}
                </div>
                <div class="card-body p-3">
                    <form method="POST" action="{{ route('profile.update') }}">
                        @csrf
                        @method('PATCH')

                        <!-- Name Field -->
                        <div class="mb-3">
                            <label for="name" class="form-label fw-semibold text-muted small">{{ __('Name') }}</label>
                            <input type="text" id="name" name="name" class="form-control form-control-sm border-1" 
                                value="{{ old('name', Auth::user()->name) }}" required>
                        </div>

                        <!-- Email Field -->
                        <div class="mb-3">
                            <label for="email" class="form-label fw-semibold text-muted small">{{ __('Email') }}</label>
                            <input type="email" id="email" name="email" class="form-control form-control-sm border-1" 
                                value="{{ old('email', Auth::user()->email) }}" required>
                        </div>

                        <div class="text-center mt-3">
                            <button type="submit" class="btn text-white btn-sm px-4"
                                style="background-color: #502159; border-radius: 6px;">
                                {{ __('Save Changes') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- Update Password Form -->
            <div class="card border-0 shadow-sm mb-3">
                <div class="card-header bg-warning text-dark fw-bold small">
                    {{ __('Update Password') }}
                </div>
                <div class="card-body p-3">
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf
                        @method('PUT')

                        <!-- Current Password -->
                        <div class="mb-2">
                            <label for="current_password" class="form-label small">{{ __('Current Password') }}</label>
                            <input type="password" id="current_password" name="current_password" class="form-control form-control-sm" required>
                        </div>

                        <!-- New Password -->
                        <div class="mb-2">
                            <label for="password" class="form-label small">{{ __('New Password') }}</label>
                            <input type="password" id="password" name="password" class="form-control form-control-sm" required>
                        </div>

                        <!-- Confirm New Password -->
                        <div class="mb-2">
                            <label for="password_confirmation" class="form-label small">{{ __('Confirm New Password') }}</label>
                            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control form-control-sm" required>
                        </div>

                        <div class="text-center mt-3">
                            <button type="submit" class="btn btn-warning btn-sm text-dark px-4">
                                {{ __('Update Password') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Delete Account Form -->
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-danger text-white fw-bold small">
                    {{ __('Delete Account') }}
                </div>
                <div class="card-body p-3">
                    <form method="POST" action="{{ route('profile.destroy') }}">
                        @csrf
                        @method('DELETE')

                        <p class="text-muted small text-center">
                            {{ __('Once deleted, your account and data will be lost. This action is irreversible.') }}
                        </p>

                        <!-- Password Confirmation -->
                        <div class="mb-2">
                            <label for="delete_password" class="form-label small">{{ __('Enter Password to Confirm') }}</label>
                            <input type="password" id="delete_password" name="password" class="form-control form-control-sm" required>
                        </div>

                        <div class="text-center mt-3">
                            <button type="submit" class="btn btn-danger btn-sm px-4">
                                {{ __('Delete Account') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
