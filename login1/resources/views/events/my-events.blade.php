@extends('layouts.app')

@section('content')
<div class="container my-5">
    <h1 class="mb-4 text-primary">My Registered Events</h1>
    <a href="{{ route('events.index') }}" class="btn btn-secondary mb-4">Back to Events</a>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Title</th>
                <th>Date</th>
                <th>Venue</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($events as $event)
            <tr>
                <td>{{ $event->title }}</td>
                <td>{{ \Carbon\Carbon::parse($event->date_time)->format('M d, Y h:i A') }}</td>
                <td>{{ $event->venue }}</td>
                <td>
                    <a href="{{ route('events.show', $event) }}" class="btn btn-primary btn-sm">Details</a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="text-center">You have not registered for any events yet.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Feedback Section -->
    @if(auth()->check())
    <div class="mt-5">
        <h2 class="text-primary">Leave Feedback</h2>
        <form action="{{ route('events.feedback', $event ?? null) }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="feedback" class="form-label">Your Feedback</label>
                <textarea name="feedback" id="feedback" class="form-control" rows="3" placeholder="Write your feedback..." required></textarea>
            </div>
            <div class="mb-3">
                <label for="rating" class="form-label">Rating (1-5)</label>
                <input type="number" name="rating" id="rating" class="form-control" min="1" max="5" placeholder="Rate the event" required>
            </div>
            <button type="submit" class="btn btn-primary">Submit Feedback</button>
        </form>
    </div>
    @endif
</div>
@endsection
