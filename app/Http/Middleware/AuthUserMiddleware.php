<?php

namespace App\Http\Middleware;

use Closure;

class AuthUserMiddleware
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
//        if ($request->user()->authorizeRoles(['profe'])) {
            $request->user()->authorizeRoles(['profe']);
//        }
        return $next($request);
    }
}
