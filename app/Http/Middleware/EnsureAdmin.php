<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check() || !Auth::user()->is_admin) {
            // Redirect non-admin users or show error
            return redirect('/')->with('error', 'You do not have admin access.');
        }
		
		//if (!auth()->check() || auth()->user()->tier !== 'admin') {
        //    abort(403);
        //}

        return $next($request);
    }
}