<?php

namespace App\Http\Middleware;

use Closure;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class ActiveAccount
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
        if ($request->user()->deleted != 0) {

            Auth::logout();
            Session::flush();
            Session::regenerate();
            request()->session()->flash('error', 'This account has been deleted');

            return redirect()->route('login');
        }
        else
            return $next($request);
        
    }
}