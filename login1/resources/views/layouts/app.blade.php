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

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
        /* RHU Color Palette */
        :root {
            --purple-main: #502159;
            --purple-secondary: #513D70;
            --purple-dark: #462755;
            --purple-light: #91569C; /* Hover color */
        }

        .navbar {
            background-color:  #dde7f4;
        }
        .navbar-brand {
            color: white !important;
            display: flex;
            align-items: center;
        }
        .navbar-brand img {
            height: 50px; /* Increased logo size */
            transition: transform 0.3s ease-in-out;
        }
        .navbar-brand img:hover {
            transform: scale(1.1); /* Slight zoom effect */
        }
        .navbar-nav .nav-link {
            color: white !important;
            transition: color 0.3s ease-in-out;
        }
        .navbar-nav .nav-link:hover {
            color: var(--purple-light) !important; /* Lighter shade of purple */
        }

        /* Dropdown Menu */
        .dropdown-menu {
            background-color: var(--purple-secondary);
        }
        .dropdown-item {
            color: white !important;
        }
        .dropdown-item:hover {
            background-color: var(--purple-light);
            color: white !important;
        }

        /* Main Heading */
        .main-heading {
            color: var(--purple-main);
        }

        /* Subheading */
        .subheading {
            color: var(--purple-secondary);
        }

        /* Button */
        .btn-primary-custom {
            background-color: var(--purple-light);
            border: none;
        }
        .btn-primary-custom:hover {
            background-color: var(--purple-dark);
        }
        </style>
        
    </head>
    <body class="font-sans antialiased">
        
        <!-- Navigation Bar -->
        <nav class="navbar navbar-expand-lg">
            <div class="container">
                <a class="navbar-brand" href="{{ route('welcome') }}">
                    <img src="{{ asset('images/logos/rhu-logo.png') }}" alt="RHU Logo" class="me-2">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
    @auth
        @if(auth()->user()->user_type === 'alumni')
            <a class="nav-link" href="{{ route('alumni.home') }}">Home</a>
        @else
            <a class="nav-link" href="{{ route('welcome') }}">Home</a>
        @endif
    @else
        <a class="nav-link" href="{{ route('welcome') }}">Home</a>
    @endauth
</li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                                Account
                            </a>
                            <ul class="dropdown-menu">
                            <li class="nav-item"><a class="nav-link text-white" href="{{ url('/upload-cv') }}">Upload my CV</a></li>
                            <li class="nav-item"><a class="nav-link text-white" href="{{ url('/profile') }}">Manage my Profile</a></li>
                            <li class="nav-item"><a class="nav-link text-white" href="{{ url('/feedback') }}">Provide Feedback</a></li>
                            <li class="nav-item"><a class="nav-link text-white" href="{{ route('applications') }}">Applications</a></li>
                                @auth
                                    <li>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                        <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>
                                    </li>
                                @else
                                    <li><a class="dropdown-item" href="{{ route('login') }}">Sign In</a></li>
                                @endauth
                            </ul>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('job.search') }}">Job Search</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('jobs.alert') }}">Job Alerts</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('events.index') }}">Events</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('mentorship') }}">Mentorship</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('career.suggester') }}">Career Suggester</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('resources') }}">Resources</a></li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Page Content -->
        <main class="py-4">
        @yield('content') <!-- This is where the 'home.blade.php' content will be injected -->
        </main>


        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>

        <!-- jQuery -->
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

        <!-- AJAX for Dynamic Page Updates -->
        <script>
            $(document).ready(function () {
                $('.ajax-link').on('click', function (e) {
                    e.preventDefault(); // Prevent default navigation

                    const url = $(this).data('url'); // Get the URL from data-url attribute

                    // Load the page content via AJAX
                    $.ajax({
                        url: url,
                        type: 'GET',
                        success: function (response) {
                            $('#content').html(response); // Update the main content
                        },
                        error: function (xhr, status, error) {
                            alert('An error occurred while loading the page. Please try again.');
                            console.error(error);
                        }
                    });
                });
            });
        </script>  
    </body>
</html>
