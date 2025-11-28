<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRole
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $user = auth()->user();

        // Check if organizer is pending
        if ($user->role === 'organizer' && $user->status === 'pending') {
            return redirect()->route('pending');
        }

        // Check if organizer is rejected
        if ($user->role === 'organizer' && $user->status === 'rejected') {
            return redirect()->route('pending');
        }

        if (!in_array($user->role, $roles)) {
            abort(403, 'Unauthorized action.');
        }

        return $next($request);
    }
}
