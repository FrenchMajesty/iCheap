<?php

namespace App\Http\Middleware\Accounts;

use Closure;

class EmailIsNotVerified
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

        if($user && !$user->email_verified) {
            return $next($request);
        }

        return redirect()->route('index');
    }
}
