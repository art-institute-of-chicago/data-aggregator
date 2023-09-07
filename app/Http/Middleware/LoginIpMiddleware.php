<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LoginIpMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $whiteIps = config('aic.auth.login_whitelist_ips');
        $passed = array_filter(array_map(function ($range) use ($request) {
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
