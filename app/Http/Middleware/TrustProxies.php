<?php

namespace App\Http\Middleware;

use App;
use Cache;
use Closure;
use Illuminate\Http\Request;
use Fideloper\Proxy\TrustProxies as Middleware;

class TrustProxies extends Middleware
{
    /**
     * The trusted proxies for this application.
     *
     * @var array
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

        $ips = Cache::remember('list-cloudfront-ips', 60*60, function () {
            return file_get_contents('http://d7uri8nf7uskq.cloudfront.net/tools/list-cloudfront-ips');
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
