<div class="container mt-5">
    <h2 class="mb-4" style="color: #7e57c2; font-weight: 700;">🎓 My Hosted Events</h2>

    @forelse ($events as $event)
        <div class="card mb-4 shadow-sm border-0" style="border-radius: 20px; background-color: #ffffff;">
            <div class="card-body px-4 py-4">
                <div class="d-flex justify-content-between align-items-start flex-wrap mb-3">
                    <div>
                        <h4 class="mb-1 text-dark font-weight-bold">{{ $event->title }}</h4>
                        <p class="mb-1 text-muted"><i class="fas fa-calendar-alt mr-1 text-primary"></i> {{ $event->date_time->format('F j, Y g:i A') }}</p>
                        <p class="mb-1 text-muted"><i class="fas fa-map-marker-alt mr-1 text-primary"></i> {{ $event->venue }}</p>
                        <p class="mt-2">
                            <span class="badge badge-pill" style="background-color: #e1bee7; color: #6a1b9a;">{{ $event->category }}</span>
                            <span class="badge badge-pill" style="background-color: #bbdefb; color: #1e88e5;">{{ $event->type }}</span>
                        </p>
                    </div>
                    <div class="text-right text-muted">
                        <small><i class="fas fa-users mr-1"></i>Seats Reserved:</small><br>
                        <span class="font-weight-bold">{{ $event->seats->count() }} / {{ $event->max_participants }}</span>
                    </div>
                </div>

                @if ($event->seats->count())
                    <div class="mb-4">
                        <h6 class="font-weight-bold text-secondary mb-2">Reserved Seats</h6>
                        <div class="table-responsive">
                            <table class="table table-sm table-borderless">
                                <thead>
                                    <tr class="text-muted">
                                        <th scope="col">Seat #</th>
                                        <th scope="col">Reserved By</th>
                                        <th scope="col">Type</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($event->seats as $seat)
                                        <tr>
                                            <td><strong>{{ $seat->seat_number }}</strong></td>
                                            <td>{{ $seat->occupant->name ?? $seat->occupant->first_name ?? 'Unnamed' }}</td>
                                            <td class="text-muted">{{ class_basename($seat->occupant_type) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endif

                <div class="mb-2">
                    <h6 class="font-weight-bold text-secondary mb-2">Feedback</h6>
                    @if ($event->feedbacks->isEmpty())
                        <p class="text-muted">No feedback submitted yet.</p>
                    @else
                        <ul class="list-group list-group-flush">
                            @foreach ($event->feedbacks as $feedback)
                                <li class="list-group-item">
                                    <blockquote class="blockquote mb-0">
                                        <p class="mb-1">{{ $feedback->comment }}</p>
                                        <footer class="blockquote-footer mt-1">
                                            {{ class_basename($feedback->author_type) }}
                                        </footer>
                                    </blockquote>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    @empty
        <div class="alert alert-info text-center">
            You haven’t hosted any events yet.
        </div>
    @endforelse
</div>
