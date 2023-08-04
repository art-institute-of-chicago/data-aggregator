<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Symfony\Component\HttpFoundation\Response;

class TrailingNewline
{
    public function handle(Request $request, Closure $next): Response
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
