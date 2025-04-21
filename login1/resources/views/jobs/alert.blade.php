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
    <h2 class="text-primary fw-bold mb-4">📢 Recent Job Activity</h2>

    @if ($activities->isEmpty())
        <div class="alert alert-info">No recent job activities found.</div>
    @else
        <ul class="list-group shadow-sm">
            @foreach ($activities as $activity)
                @php
                    $job = $activity->job;
                    $professional = $activity->professional;
                @endphp
                <li class="list-group-item d-flex flex-column flex-md-row justify-content-between align-items-start gap-3 p-4">
                    <div style="flex: 1;">
                        <p class="mb-1 text-dark">
                            💼 <strong>{{ $professional->name }}</strong> posted a job: 
                            <a href="{{ route('job.view', $job->id) }}">{{ $job->title }}</a> at <strong>{{ $job->company }}</strong>
                        </p>

                        @if ($job->deadline)
                            <p class="mb-1 text-danger small">
                                ⏳ Deadline: {{ \Carbon\Carbon::parse($job->deadline)->diffForHumans() }}
                            </p>
                        @endif

                        <div class="text-muted small">
                            @if ($job->applications->isNotEmpty())
                                📥 Applicants:
                                <ul class="list-unstyled ms-3 mt-1">
                                    @foreach ($job->applications as $app)
                                        <li>- {{ $app->student->name ?? 'Unknown' }}</li>
                                    @endforeach
                                </ul>
                            @else
                                No applicants yet.
                            @endif
                        </div>
                    </div>

                    <div>
                        <a href="{{ route('job.apply', $job->id) }}" class="btn btn-outline-primary btn-sm">
                            Apply Now
                        </a>
                    </div>
                </li>
            @endforeach
        </ul>
    @endif
</div>
@endsection
