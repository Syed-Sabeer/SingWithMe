<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class EnsureUserIsArtist
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if user is authenticated
        if (!Auth::check()) {
            return redirect()->route('artist.login')->with('error', 'Please log in to access the artist portal.');
        }

        $user = Auth::user();

        // Check if user is an artist (either has artist role or is_artist flag is true)
        if (!$user->hasRole('artist') && !$user->is_artist) {
            return redirect()->route('home')->with('error', 'Access denied. Artist privileges required.');
        }

        return $next($request);
    }
}
