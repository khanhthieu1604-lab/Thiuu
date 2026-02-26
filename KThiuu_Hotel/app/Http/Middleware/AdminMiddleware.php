<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Assuming 'role' column exists in shared users table
        // If not, we might need to fallback or the user needs to add it.
        // For safety, let's allow if role is 'admin' or 'master'
        $user = Auth::user();
        if (in_array($user->role, ['admin', 'master'])) {
            return $next($request);
        }

        abort(403, 'Unauthorized action.');
    }
}
