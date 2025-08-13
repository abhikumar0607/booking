<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class UpdateLastActivity
{
    public function handle($request, Closure $next)
    {
        $user = Auth::user();
        if ($user instanceof \App\Models\User) {
            $user->last_activity = now();
            $user->save();
        }

        return $next($request);
    }
}
