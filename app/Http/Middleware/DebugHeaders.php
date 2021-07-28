<?php

namespace App\Http\Middleware;

use Closure;

class DebugHeaders
{
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        $response->header('X-Who-Am-I', request()->ip());

        return $response;
    }
}
