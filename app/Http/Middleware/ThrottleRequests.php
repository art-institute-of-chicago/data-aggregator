<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Middleware\ThrottleRequests as BaseMiddleware;

class ThrottleRequests extends BaseMiddleware
{
    protected $requestSignature;

    /**
     * The function signature has to stay the same, but the extra parameters are ignored.
     * If the app is unrestricted or the user is logged in keep their throttle clear.
     */
    public function handle($request, Closure $next, $maxAttempts = 60, $decayMinutes = 1)
    {
        if (Auth::check() || !config('aic.auth.restricted')) {
            $key = $this->resolveRequestSignature($request);
            $this->limiter->clear($key);
        } else {
            $maxAttempts = config('aic.auth.max_attempts');
        }

        return parent::handle($request, $next, $maxAttempts, $decayMinutes);
    }

    /**
     * Rewritten so that we don't calculate request hash twice.
     */
    protected function resolveRequestSignature($request)
    {
        if (isset($this->requestSignature)) {
            return $this->requestSignature;
        }

        return $this->requestSignature = parent::resolveRequestSignature($request);
    }
}
