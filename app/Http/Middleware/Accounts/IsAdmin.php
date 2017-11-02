<?php

namespace App\Http\Middleware\Accounts;

use Closure;
use Illuminate\Support\Facades\Auth;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(!Auth::check() || Auth::user()->account != 'admin') {
            return redirect()->route('login');
        }

        return $next($request);
    }
}
