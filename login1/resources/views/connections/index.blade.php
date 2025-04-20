<!-- resources/views/connections/index.blade.php -->
@extends('layouts.app')

@section('content')
@php use App\Models\Connection; @endphp
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Network</h1>
            
            <!-- Search Form -->
            <div class="mb-4">
                <form action="{{ route('connections.index') }}" method="GET">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Search by name, industry..." value="{{ request('search') }}">
                        <button type="submit" class="btn btn-primary">Search</button>
                    </div>
                </form>
            </div>

            <!-- Users Section -->
            <div class="card mb-4">
                <div class="card-header">
                    <h2>Users</h2>
                </div>
                <div class="card-body">
                    @if($users->isEmpty())
                        <p>No users found.</p>
                    @else
                        <div class="row">
                            @foreach($users as $user)
                                <div class="col-md-4 mb-4">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center mb-3">
                                                <img src="{{ $user->profile_photo_path ? asset('storage/'.$user->profile_photo_path) : asset('images/default-profile.png') }}" 
                                                     class="rounded-circle me-3" width="50" height="50">
                                                <div>
                                                    <h5 class="mb-0">{{ $user->name }}</h5>
                                                    <p class="text-muted mb-0">{{ $user->headline }}</p>
                                                </div>
                                            </div>
                                            <p class="small">{{ Str::limit($user->about, 100) }}</p>
                                            <p class="small text-muted">{{ $user->location }}</p>
                                            
                                            <!-- Connection Status -->
                                            @if($user->connection_status === 'accepted')
                                                <span class="badge bg-success">Connected</span>
                                            @elseif($user->connection_status === 'pending')
                                            @if(Connection::where('user_id', auth()->id())
                                            ->where('connected_user_id', $user->id)
                                            ->where('connected_user_type', 'App\Models\User')
                                            ->exists())
                                                                                    <span class="badge bg-warning">Request Sent</span>
                                                @else
                                                    <span class="badge bg-warning">Pending Your Response</span>
                                                    <div class="mt-2">
                                                        <form action="{{ route('connections.accept', $user->id) }}" method="POST" class="d-inline">
                                                            @csrf
                                                            <button type="submit" class="btn btn-sm btn-success">Accept</button>
                                                        </form>
                                                        <form action="{{ route('connections.reject', $user->id) }}" method="POST" class="d-inline">
                                                            @csrf
                                                            <button type="submit" class="btn btn-sm btn-danger">Reject</button>
                                                        </form>
                                                    </div>
                                                @endif
                                            @else
                                                <form action="{{ route('connections.connect') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                                                    <input type="hidden" name="user_type" value="user">
                                                    <button type="submit" class="btn btn-sm btn-primary">Connect</button>
                                                </form>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>

            <!-- Professionals Section -->
            <div class="card">
                <div class="card-header">
                    <h2>Professionals</h2>
                </div>
                <div class="card-body">
                    @if($professionals->isEmpty())
                        <p>No professionals found.</p>
                    @else
                        <div class="row">
                            @foreach($professionals as $professional)
                                <div class="col-md-4 mb-4">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center mb-3">
                                                <img src="{{ $professional->profile_photo_path ? asset('storage/'.$professional->profile_photo_path) : asset('images/default-profile.png') }}" 
                                                     class="rounded-circle me-3" width="50" height="50">
                                                <div>
                                                    <h5 class="mb-0">{{ $professional->name }}</h5>
                                                    <p class="text-muted mb-0">{{ $professional->headline }}</p>
                                                    <p class="small text-muted mb-0">{{ $professional->company }}</p>
                                                </div>
                                            </div>
                                            <p class="small">{{ Str::limit($professional->about, 100) }}</p>
                                            <p class="small text-muted">{{ $professional->location }}</p>
                                            <p class="small text-muted">{{ $professional->industry }}</p>
                                            
                                            <!-- Connection Status -->
                                            @if($professional->connection_status === 'accepted')
                                                <span class="badge bg-success">Connected</span>
                                            @elseif($professional->connection_status === 'pending')
                                                @if(Connection::where('user_id', Auth::id())
                                                    ->where('connected_user_id', $professional->id)
                                                    ->where('connected_user_type', 'professional')
                                                    ->exists())
                                                    <span class="badge bg-warning">Request Sent</span>
                                                @else
                                                    <span class="badge bg-warning">Pending Your Response</span>
                                                    <div class="mt-2">
                                                        <form action="{{ route('connections.accept', $professional->id) }}" method="POST" class="d-inline">
                                                            @csrf
                                                            <button type="submit" class="btn btn-sm btn-success">Accept</button>
                                                        </form>
                                                        <form action="{{ route('connections.reject', $professional->id) }}" method="POST" class="d-inline">
                                                            @csrf
                                                            <button type="submit" class="btn btn-sm btn-danger">Reject</button>
                                                        </form>
                                                    </div>
                                                @endif
                                            @else
                                                <form action="{{ route('connections.connect') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="user_id" value="{{ $professional->id }}">
                                                    <input type="hidden" name="user_type" value="professional">
                                                    <button type="submit" class="btn btn-sm btn-primary">Connect</button>
                                                </form>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection