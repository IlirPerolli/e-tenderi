<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureUserHasRole
{
    public function handle(Request $request, Closure $next, $role)
    {
        if (! $request->user()->hasRole($role)) {
            abort(403, "You don't have permission!");
        }

        return $next($request);
    }
}
