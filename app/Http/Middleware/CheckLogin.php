<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;

class CheckLogin
{
    public function handle(Request $request, Closure $next)
    {
        if (!session()->has() ) {
            abort(403);
        }
        return $next($request);
    }
}
