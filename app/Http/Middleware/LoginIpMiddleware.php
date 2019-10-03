<?php

namespace App\Http\Middleware;

use Closure;

class LoginIpMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $whiteIps = config('aic.auth.login_whitelist_ips');
        $passed = array_filter(array_map(function($range) use ($request) {
            if ($this->ipInRange($request->ip(), $range)) {
                return $range;
            }
        }, $whiteIps));

        if (!$passed) {
            abort(404);
        }
        return $next($request);
    }

    /**
     * Check if a given ip is in a network
     *
     * @param  string $ip    IP to check in IPV4 format eg. 127.0.0.1
     * @param  string $range IP/CIDR netmask eg. 127.0.0.0/24, also 127.0.0.1 is accepted and /32 assumed
     * @return boolean true if the ip is in this range / false if not.
     * @see https://gist.github.com/tott/7684443
     */
    private function ipInRange($ip, $range) {
        if ( strpos( $range, '/' ) == false ) {
            $range .= '/32';
        }

        // $range is in IP/CIDR format eg 127.0.0.1/24
        list( $range, $netmask ) = explode( '/', $range, 2 );
        $range_decimal = ip2long( $range );
        $ip_decimal = ip2long( $ip );
        $wildcard_decimal = pow( 2, ( 32 - $netmask ) ) - 1;
        $netmask_decimal = ~ $wildcard_decimal;
        return ( ( $ip_decimal & $netmask_decimal ) == ( $range_decimal & $netmask_decimal ) );
    }
}
