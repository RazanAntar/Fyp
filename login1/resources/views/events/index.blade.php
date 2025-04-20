@extends('layouts.app')

@section('content')
<div class="container my-5">
    <h1 class="mb-4 text-center text-primary fw-bold">🌟 Discover Exciting Events</h1>

    <!-- Filters Section -->
    <div class="mb-4 bg-light p-4 rounded shadow-sm">
        <h5 class="text-secondary fw-bold mb-3">🔎 Filter Events</h5>
        <form method="GET" action="{{ route('events.index') }}" class="row g-3 align-items-center">
            <div class="col-md-3">
                <input type="text" name="keyword" class="form-control" placeholder="Search by title or description..." value="{{ request('keyword') }}">
            </div>
            <div class="col-md-2">
                <select name="category" class="form-select">
                    <option value="">All Categories</option>
                    <option value="Workshop" {{ request('category') == 'Workshop' ? 'selected' : '' }}>Workshop</option>
                    <option value="Job Fair" {{ request('category') == 'Job Fair' ? 'selected' : '' }}>Job Fair</option>
                    <option value="Networking" {{ request('category') == 'Networking' ? 'selected' : '' }}>Networking</option>
                </select>
            </div>
            <div class="col-md-2">
                <select name="type" class="form-select">
                    <option value="">All Types</option>
                    <option value="physical" {{ request('type') == 'physical' ? 'selected' : '' }}>Physical</option>
                    <option value="virtual" {{ request('type') == 'virtual' ? 'selected' : '' }}>Virtual</option>
                </select>
            </div>
            <div class="col-md-2">
                <input type="date" name="date" class="form-control" value="{{ request('date') }}">
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary w-100">Apply Filters</button>
            </div>
        </form>
    </div>

    <!-- Events Section -->
    <div class="row">
        @forelse ($events as $event)
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm h-100">
                
                <div class="card-body">
                    <h5 class="card-title text-primary fw-bold">{{ $event->title }}</h5>
                    <p class="card-text">
                        <strong>Date:</strong> {{ \Carbon\Carbon::parse($event->date_time)->format('M d, Y h:i A') }}<br>
                        <strong>Venue:</strong> {{ $event->venue }}<br>
                        <strong>Category:</strong> {{ $event->category }}<br>
                        @if($event->is_paid)
                        <strong>Price:</strong> ${{ number_format($event->price, 2) }}
                        @else
                        <span class="badge bg-success">Free</span>
                        @endif
                    </p>
                    @php
    $isUpcoming = \Carbon\Carbon::parse($event->date_time)->isFuture();
@endphp

@if ($isUpcoming)
    <a href="{{ route('events.show', $event) }}"
       class="btn btn-outline-primary w-100">View Details</a>
@else
    <!-- Feedback Modal Trigger -->
    <button type="button" class="btn btn-outline-secondary w-100" data-bs-toggle="modal" data-bs-target="#feedbackModal{{ $event->id }}">
        View Feedback
    </button>

    <!-- Feedback Modal -->
    <div class="modal fade" id="feedbackModal{{ $event->id }}" tabindex="-1" aria-labelledby="feedbackModalLabel{{ $event->id }}" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="feedbackModalLabel{{ $event->id }}">Feedback – {{ $event->title }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @if ($event->feedbacks->count())
                        <ul class="list-group">
                            @foreach ($event->feedbacks as $feedback)
                                <li class="list-group-item">
                                    <p class="mb-1">"{{ $feedback->comment }}"</p>
                                    <small class="text-muted">— {{ $feedback->author->name ?? 'Anonymous' }}</small>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-muted">No feedback submitted yet.</p>
                    @endif
                </div>
                <div class="modal-footer justify-content-between">
    <a href="{{ route('events.show', $event->id) }}" class="btn btn-success">
        Add Feedback
    </a>
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
</div>

            </div>
        </div>
    </div>
@endif

                </div>
            </div>
        </div>
        @empty
        <div class="col-12">
            <p class="text-center text-muted">No events available at the moment. Please check back later.</p>
        </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-4">
        {{ $events->links() }}
    </div>
</div>
@endsection
