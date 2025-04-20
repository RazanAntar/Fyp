
<style>
    .profile-card {
        background-color: #fff;
        border-radius: 16px;
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.05);
        padding: 2rem;
        margin-top: 2rem;
    }

    .profile-header {
        display: flex;
        align-items: center;
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    .profile-header .avatar {
        width: 100px;
        height: 100px;
        background-color: #dde7f4;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2.5rem;
        color: #3a4e6d;
    }

    .profile-header h2 {
        margin-bottom: 0.25rem;
    }

    .section-title {
        color: #3a4e6d;
        font-weight: 600;
        margin-top: 2rem;
        margin-bottom: 1rem;
    }

    .job-card, .event-card {
        background-color: #f3f6fb;
        border: none;
        border-radius: 12px;
        padding: 1.2rem;
        margin-bottom: 1rem;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.03);
    }

    .badge-pill {
        font-size: 0.75rem;
    }
</style>

<div class="container profile-card">
    <div class="profile-header">
        
        <div>
            <h2>{{ $professional->name }}</h2>
            <p class="text-muted mb-1"><i class="fas fa-envelope mr-1"></i>{{ $professional->email }}</p>
            <p class="text-muted"><i class="fas fa-phone-alt mr-1"></i>{{ $professional->phone }}</p>
            <p><strong>Company:</strong> {{ $professional->company }}</p>
        </div>
    </div>

    <div>
        <h4 class="section-title"><i class="fas fa-briefcase mr-2"></i>Job Postings</h4>
        @forelse ($professional->jobs as $job)
            <div class="job-card">
                <h5>{{ $job->title }}</h5>
                <p class="mb-1 text-muted">
                    <i class="fas fa-map-marker-alt mr-1"></i>{{ $job->location }} |
                    <i class="fas fa-dollar-sign mr-1"></i>{{ $job->salary }}
                </p>
                <span class="badge badge-pill badge-{{ $job->status === 'active' ? 'success' : 'secondary' }}">
                    {{ ucfirst($job->status) }}
                </span>
            </div>
        @empty
            <p class="text-muted">No jobs posted yet.</p>
        @endforelse
    </div>

    <div>
        <h4 class="section-title"><i class="fas fa-calendar-alt mr-2"></i>Events</h4>
        @forelse ($professional->events as $event)
            <div class="event-card">
                <h5>{{ $event->title }}</h5>
                <p class="mb-1 text-muted">
                    <i class="fas fa-clock mr-1"></i>{{ \Carbon\Carbon::parse($event->date_time)->format('M d, Y h:i A') }} |
                    <i class="fas fa-map-marker-alt mr-1"></i>{{ $event->venue }}
                </p>
                <span class="badge badge-pill badge-info">{{ ucfirst($event->status) }}</span>
            </div>
        @empty
            <p class="text-muted">No events hosted yet.</p>
        @endforelse
    </div>
</div>

