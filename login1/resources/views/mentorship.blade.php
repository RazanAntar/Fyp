@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2 class="text-primary fw-bold mb-4">👩‍🏫 Available Mentors</h2>

    <!-- Become a Mentor Button with Tooltip -->
    <a href="{{ route('experience.add') }}"
       class="btn btn-outline-success mb-4"
       data-bs-toggle="tooltip"
       data-bs-placement="left"
       title="Share your experience to help others grow and connect through mentorship.">
        🌟 Become a Mentor
    </a>

    {{-- My Meetings Section (Mentor View) --}}
    @if(auth()->user()->experiences->isNotEmpty())
        <div class="card shadow-sm border-0 mb-5">
            <div class="card-header bg-primary text-white fw-bold">
                📅 My Scheduled Meetings
            </div>
            <div class="card-body">
                @forelse(auth()->user()->mentorMeetings as $meeting)
                    <div class="border-bottom pb-2 mb-2">
                        <strong>With:</strong> {{ $meeting->student->name ?? 'Unknown' }}<br>
                        <strong>Date:</strong> {{ \Carbon\Carbon::parse($meeting->meeting_date)->format('M d, Y') }}<br>
                        <strong>Time:</strong> {{ \Carbon\Carbon::parse($meeting->meeting_time)->format('h:i A') }}<br>
                        <span class="badge bg-info text-dark">{{ ucfirst($meeting->status) }}</span>
                    </div>
                @empty
                    <p class="text-muted">You have no scheduled meetings yet.</p>
                @endforelse
            </div>
        </div>
    @endif

    <!-- Mentor List -->
    @if($mentors->isEmpty())
        <div class="alert alert-info">No students with experience yet.</div>
    @else
        @foreach($mentors as $mentor)
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">{{ $mentor->name }}</h5>
                    <p class="text-muted">{{ $mentor->email }}</p>

                    <ul class="mb-2">
                        @foreach ($mentor->experiences as $exp)
                            <li>
                                <strong>{{ $exp->title }}</strong> at {{ $exp->company }}<br>
                                <small>{{ $exp->start_date }} - {{ $exp->is_current ? 'Present' : $exp->end_date }}</small>
                            </li>
                        @endforeach
                    </ul>

                    @if(auth()->id() !== $mentor->id)
                        <button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#meetingModal{{ $mentor->id }}">
                            📅 Schedule a Meeting
                        </button>
                    @endif

                    <!-- Modal for Scheduling -->
                    <div class="modal fade" id="meetingModal{{ $mentor->id }}" tabindex="-1" aria-labelledby="meetingModalLabel{{ $mentor->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <form method="POST" action="{{ route('meetings.store') }}">
                                @csrf
                                <input type="hidden" name="mentor_id" value="{{ $mentor->id }}">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Schedule Meeting with {{ $mentor->name }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        @if ($mentor->timeSlots->isNotEmpty())
                                            <div class="mb-3">
                                                <label>Available Time Slots</label>
                                                <select class="form-select" name="meeting_time" required>
                                                    @foreach ($mentor->timeSlots as $slot)
                                                        <option value="{{ $slot->date }} {{ $slot->start_time }}">
                                                            {{ \Carbon\Carbon::parse($slot->date)->format('M d, Y') }} at {{ \Carbon\Carbon::parse($slot->start_time)->format('h:i A') }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        @else
                                            <p class="text-muted">No available slots currently.</p>
                                        @endif
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">Confirm Meeting</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        @endforeach
    @endif

    @if(session('error'))
        <div class="alert alert-danger mt-3">{{ session('error') }}</div>
    @endif
</div>
<!-- SweetAlert2 CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if (session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: '✅ Meeting Confirmed!',
        text: '{{ session('success') }}',
        confirmButtonColor: '#003865'
    });
</script>
@endif

@if (session('error'))
<script>
    Swal.fire({
        icon: 'error',
        title: '⚠️ Error',
        text: '{{ session('error') }}',
        confirmButtonColor: '#dc3545'
    });
</script>
@endif


@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltipTriggerList.forEach(function (tooltipTriggerEl) {
            new bootstrap.Tooltip(tooltipTriggerEl);
        });
    });
</script>
@endpush
@endsection
