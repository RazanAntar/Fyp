<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Register | Job & Internship Portal</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <style>
        /* Animation */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Background */
        body {
            background: url('{{ asset("images/background.jpg") }}') no-repeat center center;
            background-size: cover;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Poppins', sans-serif;
            backdrop-filter: blur(8px);
        }

        /* Registration Card */
        .register-card {
            background: white;
            border-radius: 12px;
            padding: 25px;
            max-width: 450px;
            width: 100%;
            box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.15);
            animation: fadeIn 0.8s ease-in-out;
        }

        /* Title */
        .register-title {
            color: #502159;
            font-weight: bold;
            text-align: center;
        }

        /* Input Fields */
        .input-field {
            border-radius: 10px;
            font-size: 14px;
            border: 2px solid #91569C;
            transition: all 0.3s ease-in-out;
        }

        .input-field:focus {
            border-color: #502159;
            box-shadow: 0px 0px 8px rgba(145, 86, 156, 0.5);
        }

        /* Register Button */
        .btn-register {
            background: #502159;
            color: white;
            border-radius: 25px;
            padding: 10px 20px;
            font-size: 14px;
            font-weight: bold;
            transition: all 0.3s ease-in-out;
            width: 100%;
        }

        .btn-register:hover {
            background: #91569C;
            transform: scale(1.05);
        }

        /* Custom Link */
        .custom-link {
            font-weight: bold;
            color: #502159;
            text-decoration: none;
            transition: color 0.3s ease-in-out;
        }

        .custom-link:hover {
            color: #91569C;
        }

        /* Small text */
        .small-text {
            font-size: 13px;
            text-align: center;
            color: gray;
        }
    </style>
</head>
<body>

    <!-- Registration Form Container -->
    <div class="register-card">
        <!-- Title -->
        <h3 class="register-title">Create an Account</h3>
        <p class="small-text">Sign up to explore job opportunities and internships.</p>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name Field -->
            <div class="mb-3">
                <label for="name" class="form-label fw-semibold" style="color: #502159;">{{ __('Full Name') }}</label>
                <input type="text" id="name" name="name" class="form-control input-field" 
                    value="{{ old('name') }}" required autofocus>
                <x-input-error :messages="$errors->get('name')" class="mt-2 text-danger small" />
            </div>

            <!-- Email Field -->
            <div class="mb-3">
                <label for="email" class="form-label fw-semibold" style="color: #502159;">{{ __('Email Address') }}</label>
                <input type="email" id="email" name="email" class="form-control input-field" 
                    value="{{ old('email') }}" required>
                <x-input-error :messages="$errors->get('email')" class="mt-2 text-danger small" />
            </div>

            <!-- Password Field -->
            <div class="mb-3">
                <label for="password" class="form-label fw-semibold" style="color: #502159;">{{ __('Password') }}</label>
                <input type="password" id="password" name="password" class="form-control input-field" required>
                <x-input-error :messages="$errors->get('password')" class="mt-2 text-danger small" />
            </div>

            <!-- Confirm Password Field -->
            <div class="mb-3">
                <label for="password_confirmation" class="form-label fw-semibold" style="color: #502159;">{{ __('Confirm Password') }}</label>
                <input type="password" id="password_confirmation" name="password_confirmation" 
                    class="form-control input-field" required>
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-danger small" />
            </div>
            <!-- Current Student or Alumni Field -->

<div class="mb-3">
    <label class="form-label fw-semibold" style="color: #502159;">{{ __('Student Status') }}</label>
    <div>
        <div class="form-check">
            <input type="radio" id="current_student" name="isGrad" value="0" class="form-check-input input-field" required>
            <label for="current_student" class="form-check-label">Current Student</label>
        </div>
        <div class="form-check">
            <input type="radio" id="alumni" name="isGrad" value="1" class="form-check-input input-field" required>
            <label for="alumni" class="form-check-label">Alumni</label>
        </div>
    </div>
    <x-input-error :messages="$errors->get('isGrad')" class="mt-2 text-danger small" />
</div>


            <!-- Submit Button -->
            <div class="text-center mt-4">
                <button type="submit" class="btn btn-register">
                    {{ __('Register') }}
                </button>
            </div>
        </form>

        <!-- Already Registered Link -->
        <div class="text-center mt-3">
            <p class="small text-muted">
                Already have an account? 
                <a href="{{ route('login') }}" class="custom-link">Login</a>
            </p>
        </div>
    </div>

</body>
</html>
