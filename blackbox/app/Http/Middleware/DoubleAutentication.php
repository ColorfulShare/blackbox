<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class DoubleAutentication
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
        if (Auth::check()) {
             View::share('show2fact', true);
            
            if (Auth::user()->activar_2fact == 0 && !empty(Auth::user()->token_google)) {
                View::share('show2fact', false);
                if (!session()->has('2fact')) {

                    session(['2fact' => 1]);
                    return redirect()->route('dashboard');
                }
            }
            
            if (!session()->has('2fact') && $request->getPathInfo() != '/2fact') {
                return redirect()->route('2fact');
            } 
        }
        return $next($request);
    }
}
