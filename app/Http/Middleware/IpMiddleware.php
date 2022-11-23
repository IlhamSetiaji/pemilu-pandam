<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IpMiddleware
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
        $allowed = [
            '182.1.82.80',
            '182.253.88.248',
            '36.72.215.106',
            '125.164.234.210',
            '203.6.149.2',
            '114.142.170.2'
        ];

        if (!in_array($request->getClientIp(), $allowed)) {
            abort(403);
        }

        return $next($request);
    }
}
