<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            if(auth()->user()->role->alias=="admin")
            {
                return redirect()->intended(route('admin'));
            }
            if(auth()->user()->role->alias=="client")
            {
                return redirect()->intended(route('client.profile'));
            }
            if(auth()->user()->role->alias=="partner")
            {
                return redirect()->intended(route('partner.index'));
            }
            return redirect(RouteServiceProvider::HOME);
        }

        return $next($request);
    }
}
