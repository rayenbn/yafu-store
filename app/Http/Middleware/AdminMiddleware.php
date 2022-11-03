<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
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
        if (Auth::check()){

            // if user assigned to any role means he is an admin
            if(Auth::user()->roles->count() > 0){
                return $next($request);
            }else {
                // return route('home');
                return redirect()->back();
            }
        }else {
            return route('home');
        }

        return $next($request);
    }
}
