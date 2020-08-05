<?php

namespace App\Http\Middleware;

use Closure;
use Symfony\Component\HttpFoundation\StreamedResponse;

class TrailingNewline
{
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        if ($response instanceof StreamedResponse) {
            return $response;
        }

        $content = $response->getContent();

        if (substr($content, -1) !== "\n") {
            $response->setContent($content . "\n");
        }

        return $response;
    }
}
