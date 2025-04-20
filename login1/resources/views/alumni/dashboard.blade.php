@extends('layouts.app')

@section('content')

<!-- Include Bootstrap CSS if not already in your layout -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;700&family=Roboto:wght@300;400&display=swap" rel="stylesheet">

<style>
    body {
        background: url('{{ asset('images/logos/rhuwelcome.jpg') }}') no-repeat center center fixed;
        background-size: cover;
        margin: 0;
        padding: 0;
        height: 100vh;
        font-family: 'Poppins', sans-serif;
    }

    .welcome-wrapper {
        backdrop-filter: blur(15px);
        background-color: rgba(85, 0, 170, 0.6); /* stronger background */
        border-radius: 20px;
        padding: 3rem 2rem;
        box-shadow: 0 0 30px rgba(123, 44, 191, 0.4);
        border: 1px solid rgba(255, 255, 255, 0.15);
        text-align: center;
        animation: fadeInScale 1.5s ease;
    }

    .welcome-title {
        font-size: 3rem;
        font-weight: 700;
        background: linear-gradient(90deg, #e0b3ff, #b37dff, #9d4edd);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        animation: slideInDown 1s ease;
    }

    .welcome-subtitle {
        font-size: 1.3rem;
        font-weight: 300;
        color: #fefefe;
        margin-top: 1rem;
        animation: slideInUp 1.2s ease;
    }

    .alumni-badge {
        display: inline-block;
        margin-top: 2rem;
        padding: 10px 25px;
        font-size: 0.95rem;
        font-weight: 500;
        border-radius: 30px;
        background: rgba(255, 255, 255, 0.15);
        color: #fff;
        border: 1px solid rgba(255, 255, 255, 0.25);
        backdrop-filter: blur(10px);
        animation: fadeIn 2s ease;
    }

    /* Animations */
    @keyframes slideInDown {
        from { transform: translateY(-30px); opacity: 0; }
        to { transform: translateY(0); opacity: 1; }
    }

    @keyframes slideInUp {
        from { transform: translateY(30px); opacity: 0; }
        to { transform: translateY(0); opacity: 1; }
    }

    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    @keyframes fadeInScale {
        from { transform: scale(0.95); opacity: 0; }
        to { transform: scale(1); opacity: 1; }
    }

    @media screen and (max-width: 600px) {
        .welcome-title {
            font-size: 2.2rem;
        }

        .welcome-subtitle {
            font-size: 1.1rem;
        }

        .alumni-badge {
            font-size: 0.85rem;
            padding: 8px 20px;
        }
    }
</style>

<div class="container-fluid d-flex justify-content-center align-items-center vh-100">
    <div class="welcome-wrapper col-11 col-md-8 col-lg-6">
        <h1 class="welcome-title">Welcome to Our Alumni Network</h1>
        <p class="welcome-subtitle">Empower Your Journey With Us</p>
        <div class="alumni-badge">Together, We Grow Stronger</div>
    </div>
</div>

@endsection
