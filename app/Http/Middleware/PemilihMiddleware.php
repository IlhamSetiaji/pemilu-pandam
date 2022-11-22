<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PemilihMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(Auth::check())
        {
            $user = request()->user();
            if($user->hasRole('pemilih'))
            {
                return $next($request);
            }
            Auth::logout($user);
            return redirect('login')->with('status','Anda bukan pemilih');
        }
        return redirect('login')->with('status','Anda belum login');
    }
}
