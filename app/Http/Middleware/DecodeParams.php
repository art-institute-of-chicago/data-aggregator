<?php

namespace App\Http\Middleware;

use Closure;

class DecodeParams
{
    /**
     * WEB-979: This middleware is a work-around for `http_build_query` and its many
     * quirks. You can pass any API params as a JSON string via the `params` param.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
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
        }

        return $next($request);
    }
}
