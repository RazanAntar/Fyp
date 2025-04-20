<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CleanEmailMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->has('email')) {
            $cleanEmail = cleanEmail($request->email);
            if (!filter_var($cleanEmail, FILTER_VALIDATE_EMAIL)) {
                // Handle the error appropriately
                abort(422, 'Invalid email format.');
            }
            $request->merge(['email' => $cleanEmail]);
        }

        return $next($request);
    }
}
