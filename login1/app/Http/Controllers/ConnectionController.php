<?php

// app/Http/Controllers/ConnectionController.php
namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Professional;
use App\Models\Connection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConnectionController extends Controller
{
// app/Http/Controllers/ConnectionController.php

public function index()
{
    // Get all users and professionals (excluding current user)
    $users = User::where('id', '!=', Auth::id())
                ->where('status', 'active')
                ->withCount(['acceptedConnections'])
                ->get();

    $professionals = Professional::where('id', '!=', Auth::id())
                ->where('status', 'active')
                ->withCount(['acceptedConnections'])
                ->get();

    // Get connection status for each
    $users->each(function ($user) {
        $user->connection_status = $this->getConnectionStatus($user);
    });

    $professionals->each(function ($professional) {
        $professional->connection_status = $this->getConnectionStatus($professional);
    });

    return view('connections.index', compact('users', 'professionals'));
}

    public function connect(Request $request)
    {
        $request->validate([
            'user_id' => 'required|integer',
            'user_type' => 'required|in:user,professional'
        ]);

        $connection = Connection::create([
            'user_id' => Auth::id(),
            'connected_user_id' => $request->user_id,
            'connected_user_type' => $request->user_type,
            'status' => 'pending'
        ]);

        // Send notification to the recipient
        // You'll need to implement your notification system here

        return back()->with('status', 'Connection request sent!');
    }

    public function accept(Connection $connection)
    {
        $this->authorize('accept', $connection);

        $connection->update(['status' => 'accepted']);

        return back()->with('status', 'Connection accepted!');
    }

    public function reject(Connection $connection)
    {
        $this->authorize('reject', $connection);

        $connection->update(['status' => 'rejected']);

        return back()->with('status', 'Connection rejected');
    }

    protected function getConnectionStatus($user)
    {
        $connection = Connection::where(function($query) use ($user) {
            $query->where('user_id', Auth::id())
                  ->where('connected_user_id', $user->id)
                  ->where('connected_user_type', get_class($user) === 'App\Models\User' ? 'user' : 'professional');
        })->orWhere(function($query) use ($user) {
            $query->where('connected_user_id', Auth::id())
                  ->where('user_id', $user->id)
                  ->where('connected_user_type', get_class(Auth::user()) === 'App\Models\User' ? 'user' : 'professional');
        })->first();

        return $connection ? $connection->status : null;
    }
    // app/Http/Controllers/ConnectionController.php

public function professionalRequests()
{
    $requests = Connection::with('user')
        ->where('connected_user_id', auth()->id())
        ->where('connected_user_type', 'App\Models\Professional')
        ->where('status', 'pending')
        ->get();

    return view('prof.requests', compact('requests'));
}
}