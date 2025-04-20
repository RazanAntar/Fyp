@extends('layouts.app')

@section('content')
<div class="container py-5">
    <!-- Back Button -->
    <div class="mb-4">
        <a href="{{ route('job.search') }}" class="btn btn-secondary rounded-pill px-4 py-2">
            ← Back to Job Search
        </a>
    </div>

    <div class="row g-5 align-items-start">
        <!-- LEFT SIDE: JOB DETAILS -->
        <div class="col-lg-6">
            <div class="mb-4">
                <p class="text-muted fw-medium mb-1" style="letter-spacing: 0.08em;">
                    #{{ strtoupper(substr($job->major, 0, 3)) }}{{ str_pad($job->id, 3, '0', STR_PAD_LEFT) }}
                </p>
                <h2 class="fw-bold mb-3" style="font-size: 36px; font-family: 'Poppins', sans-serif;">
                    {{ strtoupper($job->title) }}
                </h2>
                <div class="d-flex flex-wrap gap-3">
                    <div class="d-flex align-items-center bg-light rounded-4 px-4 py-3">
                        <img src="{{ asset('images/logos/location.png') }}" class="me-2" width="20">
                        {{ $job->remote === 'Yes' ? 'Remote' : 'Hybrid' }}
                    </div>
                    <div class="d-flex align-items-center bg-light rounded-4 px-4 py-3">
                        <img src="{{ asset('images/logos/clock.png') }}" class="me-2" width="20">
                        {{ $job->type }}
                    </div>
                    <div class="d-flex align-items-center bg-light rounded-4 px-4 py-3">
                        <img src="{{ asset('images/logos/globe.png') }}" class="me-2" width="20">
                        {{ $job->location ?? 'Beirut, Lebanon' }}
                    </div>
                </div>
            </div>

            <!-- JOB DESCRIPTION -->
            <div class="p-4 rounded-4 mb-4" style="background-color: #eef3fa;">
                <h5 class="fw-semibold mb-3">ABOUT THE POSITION</h5>
                <p style="line-height: 1.7;">{{ $job->description }}</p>
            </div>

            <!-- QUALIFICATIONS -->
            <div class="p-4 rounded-4 mb-4" style="background-color: #eef3fa;">
                <h5 class="fw-semibold mb-3">QUALIFICATIONS</h5>
                <ul class="ps-3">
                    @foreach (explode("\n", $job->requirements) as $req)
                        <li class="mb-2">{{ $req }}</li>
                    @endforeach
                </ul>
            </div>

            <!-- SKILLS -->
            <!-- SKILLS -->
@if ($job->skills && count($job->skills))
<div class="p-4 rounded-4" style="background-color: #eef3fa;">
    <h5 class="fw-semibold mb-3">REQUIRED SKILLS</h5>
    <ul class="ps-3">
        @foreach ($job->skills as $skill)
            <li class="mb-2">{{ $skill->name }}</li>
        @endforeach
    </ul>
</div>
@endif

        </div>

        <!-- RIGHT SIDE: APPLICATION FORM -->
        <div class="col-lg-6">
            <div class="p-4 rounded-4" style="background-color: #f9fbfd;">
                <h3 class="fw-semibold mb-4" style="font-family: 'Poppins', sans-serif;">Apply Now</h3>

                @if ($job->deadline)
                <div class="alert alert-warning d-flex justify-content-between align-items-center" style="font-size: 16px;">
                    <strong>⏳ Application closes in:</strong>
                    <span id="deadline-countdown" class="fw-bold text-danger">Loading...</span>
                </div>
                @endif

                <form action="{{ route('job.submitApplication', ['job' => $job->id]) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Full Name</label>
                        <input type="text" class="form-control input-custom" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email Address</label>
                        <input type="email" class="form-control input-custom" id="email" name="email" required>
                    </div>
                    
        <div class="mb-3">
            <label for="resume" class="form-label">Upload Resume</label>
            <input type="file" class="form-control" id="resume" name="resume" onchange="toggleAdditionalFields();">
            <div class="form-check mt-2">
                <input class="form-check-input" type="checkbox" id="noResume" onchange="toggleAdditionalFields();">
                <label class="form-check-label" for="noResume">
                    Check here if you do not have a resume to upload
                </label>
            </div>
            <div class="form-text mt-1 text-muted">Max file size 10MB.</div>
        </div>

                    <div id="additionalFields" style="display:none">
                        <div class="mb-3">
                            <label for="education" class="form-label">Highest Level of Education</label>
                            <input type="text" class="form-control input-custom" id="education" name="education">
                        </div>
                        <div class="mb-3">
                            <label for="experience" class="form-label">Work Experience (years)</label>
                            <input type="number" class="form-control input-custom" id="experience" name="experience" min="0">
                        </div>
                        <div class="mb-3">
                            <label for="requirements" class="form-label">Skills and Qualifications</label>
                            <div>
                                @foreach ($requirements as $requirement)
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="{{ $requirement }}" id="req-{{ $loop->index }}" name="requirements[]">
                                        <label class="form-check-label" for="req-{{ $loop->index }}">
                                            {{ $requirement }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn w-100 rounded-pill py-2 px-3" style="background-color: #003865; font-weight: 600; color: white;">
                        Submit Application
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- JS Scripts -->
<script>
function toggleAdditionalFields() {
    const resume = document.getElementById('resume');
    const noResume = document.getElementById('noResume');
    const additionalFields = document.getElementById('additionalFields');
    const education = document.getElementById('education');
    const experience = document.getElementById('experience');

    if (resume.files.length > 0 || !noResume.checked) {
        additionalFields.style.display = 'none';
        education.required = false;
        experience.required = false;
    } else {
        additionalFields.style.display = 'block';
        education.required = true;
        experience.required = true;
    }
}

window.addEventListener('DOMContentLoaded', function () {
    toggleAdditionalFields();

    @if ($job->deadline)
        const countdownElement = document.getElementById("deadline-countdown");
        const deadline = new Date("{{ \Carbon\Carbon::parse($job->deadline)->toIso8601String() }}").getTime();

        function updateCountdown() {
            const now = new Date().getTime();
            const timeLeft = deadline - now;

            if (timeLeft <= 0) {
                countdownElement.innerHTML = "Deadline Passed";
                countdownElement.classList.remove("text-danger");
                countdownElement.classList.add("text-muted");
                return;
            }

            const days = Math.floor(timeLeft / (1000 * 60 * 60 * 24));
            const hours = Math.floor((timeLeft % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((timeLeft % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((timeLeft % (1000 * 60)) / 1000);

            countdownElement.innerHTML = `${days}d ${hours}h ${minutes}m ${seconds}s`;
        }

        updateCountdown();
        setInterval(updateCountdown, 1000);
    @endif
});
</script>
@endsection
