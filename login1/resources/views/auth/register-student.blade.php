<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register - Student</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background-color: #dde7f4;
        }

        .register-card {
            background: #ffffff;
            border-radius: 16px;
            padding: 2rem;
            max-width: 500px;
            width: 100%;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.08);
        }

        .form-hint {
            font-size: 0.85rem;
            color: #6c757d;
        }

        .form-label {
            font-weight: 500;
        }

        .input-group-text {
            cursor: pointer;
            background: transparent;
            border-left: none;
        }

        .form-control:focus {
            border-color: #462755;
            box-shadow: 0 0 0 0.2rem rgba(70, 39, 85, 0.25);
        }

        .btn-primary {
            background-color: #462755;
            border: none;
            font-weight: bold;
            color: white;
        }

        .btn-primary:hover {
            background-color: #3c1f5f;
        }

        h3 {
            color: #462755;
            font-weight: bold;
        }

        a {
            color: #462755;
        }

        a:hover {
            text-decoration: underline;
            color: #3c1f5f;
        }
    </style>
</head>
<body class="d-flex align-items-center justify-content-center vh-100">

<div class="register-card">
    <!-- University Logo -->
    <div class="text-center mb-3">
        <img src="/images/logos/university-logo.png" alt="University Logo" style="max-width: 180px; height: auto;">
    </div>

    <h3 class="text-center mb-4">Student Registration</h3>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops! Something went wrong.</strong>
            <ul class="mb-0 mt-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('register.student') }}">
        @csrf
        <input type="hidden" name="user_type" value="student">

        <!-- Name -->
        <div class="mb-3">
            <label for="name" class="form-label">Full Name</label>
            <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>
        </div>

        <!-- Email -->
        <div class="mb-3">
            <label for="email" class="form-label">Email Address</label>
            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
        </div>

        <!-- Password -->
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <div class="input-group">
                <input id="password" type="password" class="form-control" name="password" required>
                <span class="input-group-text">
                    <i class="bi bi-eye-slash toggle-password" toggle="#password"></i>
                </span>
            </div>
            <div class="form-hint">Must be at least 8 characters and include letters or numbers.</div>
        </div>

        <!-- Confirm Password -->
        <div class="mb-4">
            <label for="password_confirmation" class="form-label">Confirm Password</label>
            <div class="input-group">
                <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required>
                <span class="input-group-text">
                    <i class="bi bi-eye-slash toggle-password" toggle="#password_confirmation"></i>
                </span>
            </div>
        </div>

        <button type="submit" class="btn btn-primary w-100">Register</button>

        <div class="text-center mt-3">
            <small>Already registered? <a href="{{ route('login') }}">Login here</a></small>
        </div>
    </form>
</div>

<script>
    document.querySelectorAll('.toggle-password').forEach(function (icon) {
        icon.addEventListener('click', function () {
            const target = document.querySelector(this.getAttribute('toggle'));
            const type = target.getAttribute('type');

            if (type === 'password') {
                target.setAttribute('type', 'text');
                this.classList.remove('bi-eye-slash');
                this.classList.add('bi-eye');
            } else {
                target.setAttribute('type', 'password');
                this.classList.remove('bi-eye');
                this.classList.add('bi-eye-slash');
            }
        });
    });
</script>

</body>
</html>
