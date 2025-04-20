@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-10">

    {{-- Event Card --}}
    <div class="bg-white shadow-lg rounded-2xl p-6 mb-8">
        <h2 class="text-3xl font-bold text-gray-800 mb-2">{{ $event->title }}</h2>
        <p class="text-sm text-gray-500 mb-4">
        <strong>Date:</strong>
{{ $event->date_time ? $event->date_time->format('F j, Y h:i A') : 'TBD' }}

    <br>
    <strong>Venue:</strong> {{ $event->venue ?? 'TBD' }}

    <br>
    <strong>Category:</strong> {{ $event->category ?? 'N/A' }}
</p>


        <p class="text-gray-700 leading-relaxed mb-2">{{ $event->description }}</p>

        <div class="flex justify-between items-center mt-4">
            <span class="text-sm text-gray-400">Hosted by: Admin</span>
            <span class="bg-blue-100 text-blue-800 text-xs font-semibold px-3 py-1 rounded-full">{{ $event->status }}</span>
        </div>
    </div>

    {{-- Seat Booking --}}
    <div class="bg-white shadow rounded-lg p-5 mb-6">
        <h3 class="text-xl font-semibold mb-3 text-gray-700">Reserve Your Seat</h3>
        @if (now()->lt($event->date_time))
    @if (!$hasSeat)
        <a href="{{ route('events.seating', $event->id) }}">
            <button type="button" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded">
                Select a Seat
            </button>
        </a>
    @else
        <p class="text-green-600 font-medium">You have already reserved a seat for this event.</p>
    @endif
@else
    <p class="text-red-600 font-medium">Seat reservations are closed. This event has already taken place.</p>
@endif




    </div>

    {{-- Feedback Section --}}
    @if ($event->date_time && now()->gt($event->date_time))
    <div class="bg-white shadow rounded-lg p-5 mb-6">
        <h3 class="text-xl font-semibold mb-3 text-gray-700">Submit Feedback</h3>
        <form method="POST" action="{{ route('events.feedback', $event->id) }}">
            @csrf
            <textarea name="comment" rows="4"
                class="w-full p-3 border border-gray-300 rounded-lg mb-3 focus:outline-none focus:ring focus:border-blue-400"
                placeholder="Write your feedback here..." required></textarea>
            <button type="submit"
                class="bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-4 rounded-xl">
                Submit Feedback
            </button>
        </form>
    </div>
@endif


    {{-- Existing Feedback --}}
    @if($event->feedbacks->count())
    <div class="bg-white shadow rounded-lg p-5">
        <h3 class="text-xl font-semibold mb-4 text-gray-700">Feedback from Participants</h3>
        <ul class="space-y-3">
            @foreach($event->feedbacks as $feedback)
                <li class="border-b pb-3 text-gray-700">
                    <p>"{{ $feedback->comment }}"</p>
                    <span class="text-xs text-gray-400">
                        — {{ $feedback->author->name ?? 'Anonymous' }}
                    </span>
                </li>
            @endforeach
        </ul>
    </div>
@endif



</div>
@endsection
