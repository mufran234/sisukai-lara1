<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class IsPro
{
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->tier === 'pro') {
            return $next($request);
        }
        abort(403, 'Pro tier required');
    }
}
