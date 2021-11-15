<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Middleware\TrustProxies as Middleware;
use Illuminate\Http\Request;

class TrustProxies extends Middleware
{
    /**
     * The trusted proxies for this application.
     *
     * @var array|string|null
     */
    protected $proxies = [];

    /**
     * The headers that should be used to detect proxies.
     *
     * @var string
     */
    protected $headers = Request::HEADER_X_FORWARDED_AWS_ELB;

    /**
     * Add remote address to trusted proxy list
     */
    public function handle(Request $request, Closure $next)
    {
        // WEB-979: Cache issue. Tests jumped from 1.3 min to 4.7 min!
        if (App::environment('testing')) {
            return parent::handle($request, $next);
        }

        $ips = Cache::get('list-cloudfront-ips', function () {
            if (Storage::exists('list-cloudfront-ips.json')) {
                return Storage::get('list-cloudfront-ips.json');
            }

            return '{"CLOUDFRONT_GLOBAL_IP_LIST": [], "CLOUDFRONT_REGIONAL_EDGE_IP_LIST": []}';
        });

        $ips = json_decode($ips);

        $this->proxies = array_merge(
            $this->proxies,
            $ips->{"CLOUDFRONT_GLOBAL_IP_LIST"},
            $ips->{"CLOUDFRONT_REGIONAL_EDGE_IP_LIST"}
        );

        array_push($this->proxies, $request->server->get('REMOTE_ADDR'));
        return parent::handle($request, $next);
    }
}
