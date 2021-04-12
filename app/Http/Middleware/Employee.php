<?php

namespace App\Http\Middleware;

// use Auth;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class Employee
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
        if(!Auth::check()){
            return redirect()->route("login");
        }
        
        if (Auth::user()->role=="employee"){
            return $next($request);
        }

        if (Auth::user()->role=="admin"){
         return redirect()->route("admin");
        }
    }
}
