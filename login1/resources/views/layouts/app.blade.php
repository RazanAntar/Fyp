<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --purple-main: #502159;
            --purple-secondary: #513D70;
            --purple-dark: #462755;
            --purple-light: #91569C;
        }

        body {
            font-family: 'Figtree', sans-serif;
        }

        .navbar {
            background-color: #dde7f4;
        }

        .navbar-brand img {
            height: 50px;
            transition: transform 0.3s ease-in-out;
        }

        .navbar-brand img:hover {
            transform: scale(1.05);
        }

        .navbar-nav .nav-link {
            color: var(--purple-dark) !important;
            font-weight: 500;
        }

        .navbar-nav .nav-link:hover {
            color: var(--purple-light) !important;
        }

        .dropdown-menu {
            background-color: var(--purple-secondary);
        }

        .dropdown-item {
            color: white !important;
        }

        .dropdown-item:hover {
            background-color: var(--purple-light);
        }
    </style>
</head>
<body class="font-sans antialiased">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="{{ route('welcome') }}">
                <img src="{{ asset('images/logos/rhu-logo.png') }}" alt="RHU Logo" />
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="navbar-collapse show" id="navbarNav">

                <ul class="navbar-nav ms-auto">
                    @auth
                        @if(auth()->user()->user_type === 'alumni')
                            <li class="nav-item"><a class="nav-link" href="{{ route('alumni.dashboard') }}">Alumni Dashboard</a></li>
                        @elseif(auth()->user()->user_type === 'student')
                            <li class="nav-item"><a class="nav-link" href="{{ route('dashboard') }}">Student Dashboard</a></li>
                        @endif

                        <li class="nav-item"><a class="nav-link" href="{{ route('job.search') }}">Job Search</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('jobs.alert') }}">Job Alerts</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('events.index') }}">Events</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('mentorship') }}">Mentorship</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('career.suggester') }}">Career Suggester</a></li>
                        <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" id="resourcesDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        Resources
    </a>
    <ul class="dropdown-menu" aria-labelledby="resourcesDropdown">
        <li>
            <a class="dropdown-item" href="{{ route('users.chats') }}">
                💬 Chat with Professionals
            </a>
        </li>
        <li>
            <a class="dropdown-item" href="{{ asset('documents/student_handbook.pdf') }}" target="_blank">
                📖 Student Handbook
            </a>
        </li>
        <li>
            <a class="dropdown-item" href="">
                🛠️ Help Desk
            </a>
        </li>
    </ul>
</li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                                Account
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ url('/profile') }}">Profile</a></li>
                                <li><a class="dropdown-item" href="{{ url('/upload-cv') }}">Upload CV</a></li>
                                <li><a class="dropdown-item" href="{{ route('applications') }}">Applications</a></li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item">Logout</button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @else
                        <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Sign In</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('register.alumni') }}">Register Alumni</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('register.student') }}">Register Student</a></li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <!-- Flash Message -->
    @if (session('status'))
        <div class="container mt-3">
            <div class="alert alert-success text-center">{{ session('status') }}</div>
        </div>
    @endif

    <!-- Page Content -->
    <main class="py-4">
        @yield('content')
    </main>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>
</html>
