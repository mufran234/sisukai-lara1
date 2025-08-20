<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class IsFree
{
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->tier === 'free') {
            return $next($request);
        }
        abort(403, 'Free tier only');
    }
}
