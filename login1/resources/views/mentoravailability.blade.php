@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">🗓️ My Availability</h2>

    <!-- Form to Add Availability -->
    <form action="{{ route('mentor.availability.store') }}" method="POST" class="mb-4">
        @csrf
        <div class="row g-3">
            <div class="col-md-5">
                <label class="form-label">Date</label>
                <input type="date" name="date" class="form-control" required>
            </div>
            <div class="col-md-5">
                <label class="form-label">Start Time</label>
                <input type="time" name="start_time" class="form-control" required>
            </div>
            <div class="col-md-2 d-flex align-items-end">
                <button type="submit" class="btn btn-success w-100">Add</button>
            </div>
        </div>
    </form>

    <!-- List of Time Slots -->
    <h4>📅 Your Time Slots</h4>
    @if($slots->isEmpty())
        <div class="alert alert-info">No time slots added yet.</div>
    @else
        <ul class="list-group">
            @foreach($slots as $slot)
                <li class="list-group-item d-flex justify-content-between">
                    {{ $slot->date }} at {{ \Carbon\Carbon::parse($slot->start_time)->format('h:i A') }}
                    <span class="badge {{ $slot->is_booked ? 'bg-danger' : 'bg-success' }}">
                        {{ $slot->is_booked ? 'Booked' : 'Available' }}
                    </span>
                </li>
            @endforeach
        </ul>
    @endif
</div>
@endsection
