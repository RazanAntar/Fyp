@extends('layouts.app')

@section('content')
<div class="container py-5">
    @auth
        @php
            $acceptedApplications = Auth::user()->applications()
                ->where('status', 'accepted')
                ->with('job')
                ->get();
        @endphp

        @if ($acceptedApplications->isNotEmpty())
            <div class="alert alert-success">
                <h5 class="mb-2"><i class="fas fa-check-circle mr-2"></i>🎉 Great news!</h5>
                <ul class="mb-0">
                    @foreach ($acceptedApplications as $app)
                        <li>
                            You have been <strong>accepted</strong> for the job 
                            <a href="{{ route('job.view', ['job' => $app->job->id]) }}">{{ $app->job->title }}</a> 
                            at <strong>{{ $app->job->company }}</strong>.
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif
    @endauth

    <h2 class="text-primary fw-bold mb-4">🔔 Recent Job Activity</h2>

    @if ($activities->isEmpty())
        <div class="alert alert-info">No recent job posts to show.</div>
    @else
        <ul class="list-group">
            @foreach ($activities as $activity)
                @php
                    $job = $activity->job;
                    $jobId = $job->id;
                @endphp
                <li class="list-group-item d-flex justify-content-between align-items-start flex-column flex-md-row gap-3">
                    <div style="flex: 1;">
                        <p class="mb-1">
                            💼 <strong>{{ $activity->professional->name }}</strong> posted a job:
                            <a href="{{ route('job.view', ['job' => $job->id]) }}">
                                {{ $job->title }} at {{ $job->company }}
                            </a>
                        </p>

                        @if ($job->deadline)
                            <p class="mb-1 text-danger">
                                ⏳ Deadline:
                                <span class="countdown"
                                      id="countdown-{{ $jobId }}"
                                      data-deadline="{{ \Carbon\Carbon::parse($job->deadline)->toIso8601String() }}">
                                    Loading...
                                </span>
                            </p>
                        @endif

                        @if ($job->applications->isNotEmpty())
                            <div class="mt-2">
                                <strong>📥 Applicants:</strong>
                                <ul class="list-unstyled mt-1 mb-0">
                                    @foreach ($job->applications as $application)
                                        <li class="text-muted">
                                            - {{ $application->student->name ?? 'Unknown Student' }}
                                            <small>({{ $application->created_at->diffForHumans() }})</small>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @else
                            <div class="text-muted mt-2">No applicants yet.</div>
                        @endif
                    </div>

                    <div>
                        <a id="apply-btn-{{ $jobId }}"
                           href="{{ route('job.apply', ['job' => $jobId]) }}"
                           class="btn btn-sm btn-outline-primary">
                            Apply Now
                        </a>
                    </div>
                </li>
            @endforeach
        </ul>
    @endif
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const countdowns = document.querySelectorAll(".countdown");

        countdowns.forEach(el => {
            const deadline = new Date(el.dataset.deadline).getTime();
            const jobId = el.id.split('-')[1];
            const applyBtn = document.getElementById(`apply-btn-${jobId}`);

            function updateCountdown() {
                const now = new Date().getTime();
                const timeLeft = deadline - now;

                if (timeLeft <= 0) {
                    el.innerText = "Deadline Passed";
                    el.classList.remove("text-danger");
                    el.classList.add("text-muted");

                    if (applyBtn) {
                        applyBtn.innerText = "Closed";
                        applyBtn.classList.add("disabled", "btn-secondary");
                        applyBtn.classList.remove("btn-outline-primary");
                        applyBtn.removeAttribute("href");
                    }

                    return;
                }

                const days = Math.floor(timeLeft / (1000 * 60 * 60 * 24));
                const hours = Math.floor((timeLeft % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                const minutes = Math.floor((timeLeft % (1000 * 60 * 60)) / (1000 * 60));
                const seconds = Math.floor((timeLeft % (1000 * 60)) / 1000);

                el.innerText = `${days}d ${hours}h ${minutes}m ${seconds}s`;
            }

            updateCountdown();
            setInterval(updateCountdown, 1000);
        });
    });
</script>
@endsection
