<!-- resources/views/professionals/requests.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Connection Requests</h2>
    
    @forelse($requests as $request)
        <div class="card mb-3">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <img src="{{ $request->user->profile_photo_url }}" 
                         class="rounded-circle me-3" width="60" height="60">
                    <div>
                        <h5>{{ $request->user->name }}</h5>
                        <p class="text-muted">{{ $request->user->headline }}</p>
                        <div class="btn-group">
                            <form action="{{ route('connections.accept', $request) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-success">Accept</button>
                            </form>
                            <form action="{{ route('connections.reject', $request) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-outline-danger">Reject</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="alert alert-info">No pending connection requests</div>
    @endforelse
</div>
@endsection