<?php

namespace App\Http\Middleware;

use Closure;

class LoginIpMiddleware
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
        $whiteIps = config('aic.auth.login_whitelist_ips');
        $passed = array_filter(array_map(function($range) use ($request) {
            if (ipInRange($request->ip(), $range)) {
                return $range;
            }
        }, $whiteIps));

        if (!$passed) {
            abort(404);
        }
        return $next($request);
    }
}
