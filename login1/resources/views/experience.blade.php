@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2 class="text-primary fw-bold mb-4">📝 Add Your Experience</h2>

    <div class="card shadow-sm mb-5 border-0" style="background-color: #f9fbfd;">
        <div class="card-body">
            <form action="{{ route('experience.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="title" class="form-label fw-semibold">Role/Title</label>
                    <input type="text" class="form-control rounded-pill px-4" name="title" required placeholder="e.g., Software Engineer">
                </div>
                <div class="mb-3">
                    <label for="company" class="form-label fw-semibold">Company</label>
                    <input type="text" class="form-control rounded-pill px-4" name="company" placeholder="e.g., Google">
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label fw-semibold">Description</label>
                    <textarea name="description" class="form-control rounded-4 px-4 py-2" rows="3" placeholder="Describe your role and achievements."></textarea>
                </div>

                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="start_date" class="form-label fw-semibold">Start Date</label>
                        <input type="date" class="form-control rounded-pill px-4" name="start_date">
                    </div>
                    <div class="col-md-6">
                        <label for="end_date" class="form-label fw-semibold">End Date</label>
                        <input type="date" class="form-control rounded-pill px-4" name="end_date">
                    </div>
                </div>

                <div class="form-check mt-3">
                    <input type="checkbox" class="form-check-input" name="is_current" value="1" id="is_current">
                    <label class="form-check-label" for="is_current">I am currently working here</label>
                </div>

                <button type="submit" class="btn btn-primary w-100 mt-4 rounded-pill fw-semibold py-2">
                    ➕ Add Experience
                </button>
            </form>
        </div>
    </div>

    @if(auth()->user()->experiences->isNotEmpty())
        <div class="card shadow-sm border-0 mb-5">
            <div class="card-body">
                <h5 class="text-dark fw-bold mb-3">📚 Your Experience History</h5>
                @foreach(auth()->user()->experiences as $exp)
                    <div class="border-bottom pb-3 mb-3">
                        <h6 class="mb-1 fw-semibold">{{ $exp->title }} <span class="text-muted">at {{ $exp->company }}</span></h6>
                        <small class="text-muted">{{ $exp->start_date }} — {{ $exp->is_current ? 'Present' : $exp->end_date }}</small>
                        <p class="mb-0 mt-2">{{ $exp->description }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    <!-- Button to Manage Availability -->
    <div class="text-center">
        <a href="{{ route('mentoravailability') }}" class="btn btn-outline-primary rounded-pill px-4 py-2 fw-semibold">
            🗓️ Manage My Availability
        </a>
    </div>
</div>
@endsection
