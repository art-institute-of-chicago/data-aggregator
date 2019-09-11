<?php

namespace App\Providers;

use App\Models\Passport\Client;
use App\Models\Passport\Token;
use App\Models\Passport\AuthCode;
use App\Models\Passport\PersonalAccessClient;

use Laravel\Passport\Passport;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

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

        Passport::routes(null, ['middleware' => ['checkIp']]);

        Passport::useTokenModel(Token::class);
        Passport::useClientModel(Client::class);
        Passport::useAuthCodeModel(AuthCode::class);
        Passport::usePersonalAccessClientModel(PersonalAccessClient::class);
    }
}
