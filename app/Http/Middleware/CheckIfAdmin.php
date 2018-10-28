<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckIfAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
//        dd(Auth::check() && Auth::user()->role !== 'admin');
        if (Auth::check() && Auth::user()->role == 'admin') {
            return $next($request);
        } else {
            return redirect()->guest(backpack_url('login'));
        }


    }
}
