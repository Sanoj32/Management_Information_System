<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfNotSuspended
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::guard('web')->check()) {
            if (auth('web')->user()->is_suspended) {
                return $next($request);
            } else {
                return redirect('/');
            }
        }
        if (Auth::guard('web')->check()) {
            if (auth('web')->user()->is_suspended) {
                return $next($request);
            } else {
                return redirect('/');
            }
        }
        return redirect('/');
    }
}
