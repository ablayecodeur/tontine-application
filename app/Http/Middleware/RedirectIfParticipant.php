<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RedirectIfParticipant
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check() && auth()->user()->isParticipant()) {
            return redirect()->route('participant.dashboard');
        }

        return $next($request);
    }
}
