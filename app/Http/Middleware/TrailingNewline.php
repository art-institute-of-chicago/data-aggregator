<?php

namespace App\Http\Middleware;

use Closure;

class TrailingNewline
{
    public function handle($request, Closure $next)
    {
        $response = $next($request);
        $content = $response->getContent();

        if (substr($content, -1) !== "\n") {
            $response->setContent($content . "\n");
        }

        return $response;
    }
}
