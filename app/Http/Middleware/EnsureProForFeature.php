<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Carbon\Carbon;

class EnsureProForFeature {
  public function handle(Request $request, Closure $next) {
    $u = auth()->user();
    $ok = $u && $u->tier === 'pro' && $u->pro_until && Carbon::parse($u->pro_until)->isFuture();
    if (!$ok) return redirect()->route('dashboard')->with('error','Upgrade to Pro to access this feature.');
    return $next($request);
  }
}