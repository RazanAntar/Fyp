@extends('layouts.app')

@section('content')


    <div style="background: url('{{ asset('images/logos/dashboard.jpg') }}') no-repeat center center fixed; background-size: cover; height: 100vh; width: 100%; position: relative; display: flex; justify-content: center; align-items: center;">
<!-- Centered Caption with Dynamic Styling -->
<div class="text-white text-center fw-bold p-4 rounded shadow-lg neon-border animate-fade-in"
     style="
        font-size: 32px; 
        font-weight: 700;
        padding: 25px;
        border-radius: 15px; 
        background: linear-gradient(135deg, rgba(80, 33, 89, 0.8), rgba(0, 0, 0, 0.8));
        backdrop-filter: blur(12px);
        box-shadow: 0px 0px 20px rgba(255, 255, 255, 0.3);
        max-width: 75%;
        margin: 50px auto;
        text-shadow: 3px 3px 10px rgba(0, 0, 0, 0.7);
        letter-spacing: 1.5px;
        transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
     ">
    🚀 <span class="glow-text">Welcome to Our Dashboard</span> – Empower Your Journey with Us! 
</div>
<!-- Example button in your navigation or dashboard -->

<!-- Custom Glow Effect & Animations -->
<style>
    /* Glow Effect on Text */
    .glow-text {
        background: linear-gradient(90deg, #ff9a9e, #fad0c4, #ffdde1, #fad0c4);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        animation: glow-animation 3s infinite alternate;
    }

    /* Neon Border Effect */
    .neon-border {
        border: 2px solid rgba(255, 255, 255, 0.3);
        animation: neon-glow 1.5s infinite alternate;
    }

    /* Smooth Fade-in Animation */
    .animate-fade-in {
        opacity: 0;
        animation: fadeIn ease-in 1.2s forwards;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(-20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    /* Glow Animation */
    @keyframes glow-animation {
        from { text-shadow: 0px 0px 5px rgba(255, 255, 255, 0.5); }
        to { text-shadow: 0px 0px 20px rgba(255, 255, 255, 0.8); }
    }

    /* Neon Glow for Border */
    @keyframes neon-glow {
        from { box-shadow: 0px 0px 8px rgba(255, 255, 255, 0.4); }
        to { box-shadow: 0px 0px 18px rgba(255, 255, 255, 0.7); }
    }

    /* Hover Effect */
    .neon-border:hover {
        transform: scale(1.05);
        box-shadow: 0px 0px 25px rgba(255, 255, 255, 0.6);
    }
    </style>

    </div>

    @endsection



