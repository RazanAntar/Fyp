@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto p-6">
    <h2 class="text-2xl font-bold mb-4">Select Your Seat for {{ $event->title }}</h2>

    <form method="POST" action="{{ route('events.reserveSeat', $event->id) }}">
        @csrf
        <div class="grid grid-cols-5 gap-3">
            @foreach($seats as $seat)
                <label class="block text-center border p-3 rounded cursor-pointer
                              {{ $seat->occupied ? 'bg-red-300 cursor-not-allowed' : 'bg-green-200 hover:bg-green-300' }}">
                    @if(!$seat->occupied)
                        <input type="radio" name="seat_number" value="{{ $seat->seat_number }}" class="hidden" required>
                    @endif
                    {{ $seat->seat_number }}
                </label>
            @endforeach
        </div>

        <button type="submit" class="mt-5 px-4 py-2 bg-blue-600 text-white rounded">Reserve Seat</button>
    </form>
</div>
@endsection
