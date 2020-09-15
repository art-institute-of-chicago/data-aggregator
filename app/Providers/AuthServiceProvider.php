<?php

namespace App\Providers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as BaseServiceProvider;

class AuthServiceProvider extends BaseServiceProvider
{
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    public function boot()
    {
        $this->registerPolicies();

        Gate::define('restricted-access', function ($user = null) {
            // If we're not applying restriction, you shall pass
            if (!config('aic.auth.restricted')) {
                return true;
            }

            // If your token is valid, you shall pass
            if (Auth::check()) {
                return true;
            }

            // If your IP is within a whitelisted range, you shall pass
            $whitelistedRanges = config('aic.auth.access_whitelist_ips');
            $matchingRanges = array_filter(array_map(function ($range) {
                if (ipInRange(request()->ip(), $range)) {
                    return $range;
                }
            }, $whitelistedRanges));

            if (count($matchingRanges) > 0) {
                return true;
            }

            // Otherwise, you shall not pass
            return false;
        });
    }
}
