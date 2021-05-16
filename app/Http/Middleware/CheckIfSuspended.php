<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckIfSuspended
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
            if (Auth::guard('web')->user()->is_suspended) {
                Auth::logout();
                $request->session()->invalidate();

                $request->session()->regenerateToken();
                return redirect('/suspended')->with('accountSuspended', 'Your account has been suspended');
            }
        }
        if (Auth::guard('admin')->check()) {
            if (Auth::guard('admin')->user()->is_suspended) {
                Auth::logout();
                $request->session()->invalidate();

                $request->session()->regenerateToken();
                return redirect('/suspended')->with('accountSuspended', 'Your account has been suspended');
            }
        }
        return $next($request);
    }
}
