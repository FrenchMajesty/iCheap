<?php

namespace App\Http\Middleware\Accounts;

use Closure;

class EmailIsVerified
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
        $user = \Auth::user();
        if($user && $user->email_verified) {
            return $next($request);
        }

        return redirect()->route('request.verify.email');
    }
}
