<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register - Alumni</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a2e0e9b6e8.js" crossorigin="anonymous"></script> <!-- FontAwesome for eye icon -->

    <style>
        body {
            background-color: #dde7f4;
        }

        .card {
            border-radius: 16px;
            border: none;
            background-color: white;
        }

        h3.text-center {
            color: #462755;
            font-weight: bold;
        }

        .form-control:focus {
            border-color: #462755;
            box-shadow: 0 0 0 0.2rem rgba(70, 39, 85, 0.25);
        }

        .form-error {
            font-size: 0.875rem;
            color: red;
        }

        .password-hint {
            font-size: 0.8rem;
            color: #6c757d;
            margin-top: 4px;
        }

        .input-group-text {
            cursor: pointer;
        }

        .btn-primary {
            background-color: #462755;
            border: none;
            font-weight: bold;
            color: white;
        }

        .btn-primary:hover {
            background-color: #3c1f5f;
            color: white;
        }

        a {
            color: #462755;
            font-weight: 500;
        }

        a:hover {
            text-decoration: underline;
            color: #3c1f5f;
        }
    </style>
</head>
<body class="d-flex align-items-center justify-content-center vh-100">

<div class="card p-4 shadow" style="width: 100%; max-width: 500px;">
<div class="text-center mb-4">
    <img src="/images/logos/university-logo.png"
         alt="University Logo"
         style="max-width: 180px; height: auto;">
</div>

    <h3 class="text-center mb-4">Alumni Registration</h3>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Please fix the following errors:</strong>
            <ul class="mb-0 mt-2">
                @foreach ($errors->all() as $error)
                    <li class="small">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('register.alumni') }}">
        @csrf

        <input type="hidden" name="user_type" value="alumni">

        <!-- Full Name -->
        <div class="mb-3">
            <label for="name" class="form-label">Full Name</label>
            <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>
            @error('name')
            <div class="form-error">{{ $message }}</div>
            @enderror
        </div>

        <!-- Email -->
        <div class="mb-3">
            <label for="email" class="form-label">Email Address</label>
            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
            @error('email')
            <div class="form-error">{{ $message }}</div>
            @enderror
        </div>

        <!-- Password -->
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <div class="input-group">
                <input id="password" type="password" class="form-control" name="password" required>
                <span class="input-group-text" onclick="togglePassword('password', this)">
                    <i class="fas fa-eye"></i>
                </span>
            </div>
            <div class="password-hint">
                Must be at least 8 characters and match the confirmation field.
            </div>
            @error('password')
            <div class="form-error">{{ $message }}</div>
            @enderror
        </div>

        <!-- Confirm Password -->
        <div class="mb-4">
            <label for="password_confirmation" class="form-label">Confirm Password</label>
            <div class="input-group">
                <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required>
                <span class="input-group-text" onclick="togglePassword('password_confirmation', this)">
                    <i class="fas fa-eye"></i>
                </span>
            </div>
        </div>

        <button type="submit" class="btn btn-primary w-100">Register as Alumni</button>

        <div class="text-center mt-3">
            <small>Already registered? <a href="{{ route('login') }}">Login here</a></small>
        </div>
    </form>
</div>

<script>
    function togglePassword(id, el) {
        const input = document.getElementById(id);
        const icon = el.querySelector('i');
        if (input.type === "password") {
            input.type = "text";
            icon.classList.remove("fa-eye");
            icon.classList.add("fa-eye-slash");
        } else {
            input.type = "password";
            icon.classList.remove("fa-eye-slash");
            icon.classList.add("fa-eye");
        }
    }
</script>

</body>
</html>
