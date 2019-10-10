<?php

namespace App\Providers;

use App\Models\Passport\Client;
use App\Models\Passport\Token;
use App\Models\Passport\AuthCode;
use App\Models\Passport\PersonalAccessClient;

use Laravel\Passport\Passport;

use Illuminate\Http\Request;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * We create auth-related tables via a custom connection, so that it doesn't
     * get reset when we switch to a new table version or reset our database.
     * Due to this approach, we do not use Passport's default migrations.
     */
    public function register()
    {
        Passport::ignoreMigrations();
    }

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
            $matchingRanges = array_filter(array_map(function($range) {
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

        Passport::routes(null, ['middleware' => ['loginIp']]);

        Passport::useTokenModel(Token::class);
        Passport::useClientModel(Client::class);
        Passport::useAuthCodeModel(AuthCode::class);
        Passport::usePersonalAccessClientModel(PersonalAccessClient::class);
    }
}
