<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DebugHeaders
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        $response->header('X-Who-Am-I', request()->ip());

        return $response;
    }
}
