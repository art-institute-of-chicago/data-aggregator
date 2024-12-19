<?php

namespace App\Http\Middleware;

class AIServiceStatus
{
    public function handle($request, \Closure $next)
    {
        if (!config('azure.status', false)) {
            return response()->json([
                'error' => 'AI services are currently disabled'
            ], 503);
        }

        return $next($request);
    }
}
