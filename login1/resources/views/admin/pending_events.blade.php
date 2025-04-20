
<div class="container">
    <h1>Pending Events</h1>
    <ul class="list-group">
        @foreach ($events as $event)
            <li class="list-group-item">
                {{ $event->name }} - <small>{{ $event->date }}</small>
                <form method="POST" action="{{ route('events.approve', $event->id) }}">
                    @csrf
                    <button type="submit" class="btn btn-success">Approve</button>
                </form>
            </li>
        @endforeach
    </ul>
</div>

