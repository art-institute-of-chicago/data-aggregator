<?php

namespace App\Http\Middleware;

use Symfony\Component\HttpFoundation\ParameterBag;
use Closure;

class DecodeParams
{
    /**
     * WEB-979: This middleware is a work-around for `http_build_query` and its many
     * quirks. You can pass any API params as a JSON string via the `params` param.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $params = $request->get('params');

        if (isset($params)) {
            $params = json_decode($params, true);

            if (json_last_error() === JSON_ERROR_NONE) {
                $request->merge($params);
            }

            // Prevents issues with `msearch`, which expects array as root item
            $request->query = new ParameterBag($request->except(['params']));
        }

        return $next($request);
    }
}
