<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Login | Job & Internship Portal</title>

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Google Font -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

  <style>
    :root {
      --light-blue: #dde7f4;
      --main-purple: #462755;
      --navy-blue: #083F6B;
    }

    * {
      box-sizing: border-box;
    }

    body {
      margin: 0;
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(to right, #dde7f4, #e6ecf5);
      min-height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .login-wrapper {
      background: #fff;
      padding: 2.8rem 3rem;
      border-radius: 24px;
      box-shadow: 0 15px 40px rgba(0, 0, 0, 0.08);
      max-width: 460px;
      width: 100%;
      animation: fadeIn 0.6s ease;
    }

    @keyframes fadeIn {
      from {
        opacity: 0;
        transform: translateY(30px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .login-wrapper img {
      display: block;
      margin: 0 auto 1.2rem;
      width: 75px;
    }

    .login-wrapper h2 {
      color: var(--main-purple);
      font-weight: 700;
      font-size: 26px;
      text-align: center;
      margin-bottom: 0.4rem;
    }

    .login-wrapper p {
      color: var(--navy-blue);
      font-size: 15px;
      text-align: center;
      margin-bottom: 1.6rem;
    }

    .form-label {
      font-weight: 600;
      color: var(--navy-blue);
      margin-bottom: 5px;
      font-size: 15px;
    }

    .form-control {
      border-radius: 10px;
      padding: 12px 16px;
      font-size: 15px;
      border: 1.6px solid var(--light-blue);
    }

    .form-control:focus {
      border-color: var(--main-purple);
      box-shadow: 0 0 6px rgba(70, 39, 85, 0.2);
    }

    .btn-login {
      width: 100%;
      padding: 12px;
      border: none;
      border-radius: 30px;
      background-color: var(--main-purple);
      color: #fff;
      font-weight: bold;
      font-size: 16px;
      transition: 0.3s ease;
      margin-top: 10px;
    }

    .btn-login:hover {
      background-color: var(--navy-blue);
    }

    .form-check-label {
      font-size: 14px;
    }

    .custom-link {
      color: var(--main-purple);
      text-decoration: none;
      font-weight: 500;
      font-size: 14px;
    }

    .custom-link:hover {
      color: var(--navy-blue);
      text-decoration: underline;
    }

    .divider {
      margin: 22px 0 12px;
      text-align: center;
      font-size: 13px;
      color: #888;
    }

    .footer-links {
      text-align: center;
      font-size: 14px;
      color: #666;
      margin-top: 14px;
    }

    .footer-links a {
      display: block;
      margin-top: 4px;
    }

    .back-floating {
  position: absolute;
  top: 25px;
  left: 25px;
  z-index: 10;
  display: inline-block;
}

.back-floating img {
  width: 28px;
  height: 28px;
  transition: transform 0.2s ease;
}

.back-floating:hover img {
  transform: translateX(-4px);
}


    @media (max-height: 700px) {
      .login-wrapper {
        padding: 2.2rem 2.4rem;
      }

      .login-wrapper h2 {
        font-size: 22px;
      }

      .login-wrapper p {
        font-size: 13px;
        margin-bottom: 1.2rem;
      }

      .btn-login {
        padding: 10px;
        font-size: 15px;
      }
    }
  </style>
</head>
<body>
<a href="/" class="back-floating">
  <img src="{{ asset('images/logos/purple-arrow.png') }}" alt="Back">
</a>

  <div class="login-wrapper">
    <img src="{{ asset('images/logos/rhulogo-removebg-preview.png') }}" alt="Logo">

    <h2>Welcome Back</h2>
    <p>Login to explore internships, career opportunities & more</p>
    @if ($errors->has('account_inactive'))
    <div class="alert alert-warning text-center small">
        {{ $errors->first('account_inactive') }}
    </div>
@endif

    <x-auth-session-status class="mb-3 text-success" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
      @csrf

      <div class="mb-3">
        <label for="email" class="form-label">Email Address</label>
        <input type="email" name="email" id="email" class="form-control" required value="{{ old('email') }}">
        <x-input-error :messages="$errors->get('email')" class="text-danger small mt-1" />
      </div>

      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" name="password" id="password" class="form-control" required>
        <x-input-error :messages="$errors->get('password')" class="text-danger small mt-1" />
      </div>

      <div class="form-check mb-3">
        <input type="checkbox" class="form-check-input" id="remember_me" name="remember">
        <label class="form-check-label" for="remember_me">Remember Me</label>
      </div>

      <button type="submit" class="btn-login">Log In</button>
    </form>

    <div class="divider">
      @if (Route::has('password.request'))
        <a class="custom-link" href="{{ route('password.request') }}">Forgot Password?</a>
      @endif
    </div>

    <div class="footer-links">
      <p class="mb-1">Don't have an account?</p>
      <a href="{{ route('register.student') }}" class="custom-link">Register as Student</a>
      <a href="{{ route('register.alumni') }}" class="custom-link">Register as Alumni</a>
    </div>
  </div>

  

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
