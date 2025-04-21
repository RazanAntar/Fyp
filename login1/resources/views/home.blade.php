@extends('layouts.app')

@section('content')
<!-- HERO SECTION -->
<section class="text-center py-5" style="background: linear-gradient(135deg, #ffffff, #f6f9fc); font-family: 'Poppins', sans-serif;">
    <p class="text-uppercase mb-2" style="font-weight: 600; letter-spacing: 0.2em; font-size: 14px; color: #4A90E2;">Careers</p>

    <h1 class="fw-bold mb-4" style="font-size: 50px; line-height: 1.2;">
        YOUR <span style="color: #4A90E2;">GROWTH</span><br>
        OUR <span style="color: #083F6B;">VISION</span>
    </h1>

    <p class="mt-3 mx-auto mb-4" style="max-width: 800px; font-size: 18px; color: #2c3e50; font-weight: 400;">
        Explore exclusive job and internship opportunities tailored for <strong>Rafik Hariri University students</strong>.
        Step confidently into a future where your education meets real-world impact. Our PLATFORM is your gateway to meaningful professional experiences and career growth.
    </p>

    <a href="#jobSection" class="btn px-5 py-3 rounded-pill text-white shadow" style="background-color: #003865; font-size: 18px; font-weight: 600; letter-spacing: 0.08em; margin-top: 2.5rem;">
        SEE JOB OPPORTUNITIES
    </a>

    <!-- Animated Arrow -->
    <div style="position: relative; margin-top: 50px;">
        <img src="{{ asset('images/logos/down_arrow (2).png') }}" alt="↓"
             style="width: 120px; position: absolute; bottom: -10px; left: 65%; transform: translateX(-45%); animation: bounce 2s infinite;">
    </div>
</section>

<!-- Smart Job Matching Panel -->
<!-- Smart Job Matching Panel -->
<div class="container my-5" style="font-family: 'Poppins', sans-serif;">
    <div class="bg-white p-5 rounded-4 shadow-sm border" style="border-color: #4A90E2;">
        <h4 class="text-primary fw-bold mb-4 d-flex align-items-center" style="font-size: 22px; color: #003865;">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#4A90E2" class="bi bi-stars me-2" viewBox="0 0 16 16">
                <path d="M7.5 0.5a.5.5 0 0 1 .5.5v1.146l.65.342.342.65h1.146a.5.5 0 0 1 0 1h-1.146l-.342.65-.65.342V5.5a.5.5 0 0 1-1 0V4.354l-.65-.342-.342-.65H4.5a.5.5 0 0 1 0-1h1.146l.342-.65.65-.342V1a.5.5 0 0 1 .5-.5z"/>
                <path d="M4.267 7.133a.5.5 0 0 1 .592-.592l.768.153.307-.615a.5.5 0 0 1 .897 0l.307.615.768-.153a.5.5 0 0 1 .592.592l-.153.768.615.307a.5.5 0 0 1 0 .897l-.615.307.153.768a.5.5 0 0 1-.592.592l-.768-.153-.307.615a.5.5 0 0 1-.897 0l-.307-.615-.768.153a.5.5 0 0 1-.592-.592l.153-.768-.615-.307a.5.5 0 0 1 0-.897l.615-.307-.153-.768z"/>
            </svg>
            Smart Job Matching
        </h4>

        <form method="POST" action="{{ route('job.match.process') }}">
            @csrf
            <div class="mb-3">
                <input type="text" name="profile_input" class="form-control form-control-lg rounded-pill px-4 py-3" placeholder="e.g. Computer Science, Python, AI" required>
            </div>
            <button type="submit" class="btn w-100 py-3 rounded-pill fw-semibold" style="background-color: #003865; color: white; font-size: 16px;">
                Find Matching Jobs
            </button>
        </form>
    </div>
</div>


@if (session('matches'))
    <div class="mt-4">
        <h5 class="text-success fw-bold mb-3">🔍 Top Matches Based on Your Profile</h5>

        @if(count(session('matches')) === 0)
            <div class="alert alert-warning">
                ⚠️ No matching jobs found for your profile. Try different keywords.
            </div>
        @else
            <ul class="list-group shadow-sm rounded">
            @foreach (session('matches') as $match)
    @if ($match['score'] > 0)
        <li class="list-group-item d-flex justify-content-between align-items-center py-3 px-4">
            <div>
                <strong>{{ $match['title'] }}</strong> at {{ $match['company'] ?? 'Unknown' }}<br>
                <small class="text-muted">Match Score: {{ number_format($match['score'], 2) }}</small>
            </div>
            <a href="{{ route('job.apply', ['job' => $match['id']]) }}" class="btn btn-primary btn-sm px-3">Apply Now</a>
        </li>
    @endif
@endforeach

            </ul>
        @endif
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger mt-3">
        @foreach ($errors->all() as $error)
            <div>❌ {{ $error }}</div>
        @endforeach
    </div>
@endif




<!-- JOB SECTION -->
<section id="jobSection" class="container py-3" style="font-family: 'Poppins', sans-serif;">
    <p class="text-center text-uppercase fw-medium mb-2" style="font-size: 15px; letter-spacing: 0.08em; color: #4A90E2;">We’re Hiring!</p>
    <h2 class="text-center fw-bold mb-3" style="font-size: 34px;">Open Positions</h2>
    <p class="text-center text-muted mb-4" style="font-size: 16px;">
        Discover curated internships and jobs for our university community. Need help? Contact 
        <a href="mailto:careers@university.edu" class="text-decoration-none fw-medium" style="color: #4A90E2;">careers@university.edu</a>
    </p>

    <!-- FILTERS -->
    <div class="d-flex flex-column flex-md-row justify-content-center align-items-center gap-3 mb-4">
        <!-- Type Filter -->
        <div class="bg-white p-3 px-4 rounded-pill d-inline-flex justify-content-center gap-4 shadow-sm" style="max-width: 620px;">
            <button class="filter-tab active" onclick="filterJobs('all')">View all</button>
            <button class="filter-tab" onclick="filterJobs('Full-time')">Full Time</button>
            <button class="filter-tab" onclick="filterJobs('Internship')">Internship</button>
        </div>

        <!-- Major Filter -->
        <div class="position-relative" style="width: 240px;">
            <select id="majorFilter"
                    class="form-select shadow-sm"
                    style="background-color: #f4f7fb; border-radius: 50px; padding: 12px 48px 12px 48px; font-size: 15px; font-family: 'Poppins', sans-serif; border: 1px solid #ced4da;">
                <option value="all">Filter by Major</option>
                @foreach (array_unique($jobs->pluck('major')->toArray()) as $major)
                    <option value="{{ $major }}">{{ $major }}</option>
                @endforeach
            </select>
            <img src="{{ asset('images/logos/search.png') }}" alt="search" style="position: absolute; top: 50%; left: 16px; transform: translateY(-50%); width: 18px; height: 18px;">
        </div>
    </div>

    <!-- JOB LISTINGS -->
    <div id="jobList" class="d-flex flex-column gap-4">
        @foreach ($jobs as $job)
            <div class="p-4 job-card bg-white rounded-4 border" data-type="{{ $job->type }}" data-major="{{ $job->major }}" style="border: 2px solid #4A90E2;">
                <div class="d-flex justify-content-between flex-column flex-md-row gap-4 align-items-start">
                    <div>
                        <p class="text-muted mb-1" style="font-size: 14px;">#{{ strtoupper(substr($job->major, 0, 3)) }}{{ str_pad($job->id, 3, '0', STR_PAD_LEFT) }}</p>
                        <h5 class="fw-semibold mb-2" style="font-size: 20px; color: #1c1c1c;">{{ $job->title }}</h5>
                        <span class="badge px-3 py-2 rounded-pill bg-light text-primary fw-medium" style="font-size: 14px;">{{ $job->major }}</span>
                        <div class="d-flex gap-4 mt-3 text-secondary align-items-center" style="font-size: 15px;">
                            <span class="d-flex align-items-center gap-1">
                                <img src="{{ asset('images/logos/location.png') }}" width="20" height="20" alt="location"> 
                                {{ $job->remote === 'Yes' ? 'Remote' : 'Hybrid' }}
                            </span>
                            <span class="d-flex align-items-center gap-1">
                                <img src="{{ asset('images/logos/clock.png') }}" width="20" height="20" alt="clock"> 
                                {{ $job->type }}
                            </span>
                        </div>
                    </div>

                    <div class="text-md-end mt-3 mt-md-0">
                        <a href="{{ route('job.apply', ['job' => $job->id]) }}"
                           class="btn btn-primary d-inline-flex align-items-center gap-2 px-4 py-2 rounded-pill"
                           style="background-color: #4A90E2; border: none; font-size: 15px;">
                            Apply for Job
                            <img src="{{ asset('images/logos/apply_arrow.png') }}" alt="↗" style="width: 18px;">
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</section>
@if (session('success'))
<script>
    Swal.fire({
        title: '🎉 Application Submitted!',
        text: 'We hope you get accepted!',
        icon: 'success',
        confirmButtonText: 'OK',
        confirmButtonColor: '#003865'
    });
</script>
@endif

<!-- SCRIPTS -->
<script>
    function filterJobs(type) {
        document.querySelectorAll('.filter-tab').forEach(btn => btn.classList.remove('active'));
        event.target.classList.add('active');

        const selectedMajor = document.getElementById('majorFilter').value;
        const cards = document.querySelectorAll('.job-card');

        cards.forEach(card => {
            const matchesType = type === 'all' || card.dataset.type === type;
            const matchesMajor = selectedMajor === 'all' || card.dataset.major === selectedMajor;

            card.style.display = (matchesType && matchesMajor) ? 'block' : 'none';
        });
    }

    document.getElementById('majorFilter').addEventListener('change', () => {
        const activeTab = document.querySelector('.filter-tab.active');
        const type = activeTab ? activeTab.textContent.trim() : 'all';
        filterJobs(type);
    });
</script>

<!-- STYLES -->
<style>
    .filter-tab {
        background-color: transparent;
        border: none;
        color: #6c757d;
        font-weight: 500;
        padding: 10px 24px;
        border-radius: 50px;
        transition: all 0.2s ease-in-out;
        font-size: 15px;
    }

    .filter-tab.active {
        background-color: #ffffff;
        color: #000000;
        box-shadow: 0 3px 8px rgba(0,0,0,0.08);
    }

    .filter-tab:hover {
        background-color: #ffffff;
        color: #000000;
    }

    .job-card {
    border: 2px solid #a9c9f2 !important; /* light soft blue */
    box-shadow: 0 4px 14px rgba(169, 201, 242, 0.25); /* subtle blue shadow */
    transition: transform 0.2s ease, box-shadow 0.2s ease;
    border-radius: 1rem;
    background-color: #ffffff;
}

.job-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 8px 20px rgba(169, 201, 242, 0.4); /* slightly stronger on hover */
}


    @keyframes bounce {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(8px); }
    }
</style>
@endsection
