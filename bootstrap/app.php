<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Route;
use Sentry\Laravel\Integration;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
        then: function () {
            Route::middleware('ai.service.status')
                ->prefix('ai')
                ->group(base_path('routes/ai.php'));

            Route::middleware('api')
                ->prefix('la')
                ->group(base_path('routes/la.php'));

            Route::middleware('api')
                ->prefix('csv')
                ->group(base_path('routes/csv.php'));
        }
    )
    ->withMiddleware(function (Middleware $middleware) {
        // Override middleware so we can add our own TrustProxies middleware
        $middleware->use([
            \App\Http\Middleware\TrustProxies::class,
            \Illuminate\Http\Middleware\HandleCors::class,
            \Illuminate\Foundation\Http\Middleware\PreventRequestsDuringMaintenance::class,
            \Illuminate\Http\Middleware\ValidatePostSize::class,
            \Illuminate\Foundation\Http\Middleware\TrimStrings::class,
            \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
            \Illuminate\Foundation\Http\Middleware\InvokeDeferredCallbacks::class,

            \Aic\Hub\Foundation\Middleware\ETagMiddleware::class,
            \Aic\Hub\Foundation\Middleware\RedirectTrailingSlash::class,
            \App\Http\Middleware\TrailingNewline::class,
            // \App\Http\Middleware\DebugHeaders::class,
        ]);

        // $middleware->trustHosts();

        $middleware->web(append: [
            \Illuminate\Cookie\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ]);

        $middleware->api(append: [
            \App\Http\Middleware\DecodeParams::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
            'auth:api',
            // \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
            // WEB-1929: Enable throttling when ready!
            // \App\Http\Middleware\ThrottleRequests::class.':api',
            'restrict',
        ]);

        $middleware->alias([
            'ai.service.status' => \App\Http\Middleware\AIServiceStatus::class,
            'auth' => \App\Http\Middleware\Authenticate::class,
            'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
            'auth.session' => \Illuminate\Session\Middleware\AuthenticateSession::class,
            'cache.headers' => \Illuminate\Http\Middleware\SetCacheHeaders::class,
            'can' => \Illuminate\Auth\Middleware\Authorize::class,
            // 'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
            // 'password.confirm' => \Illuminate\Auth\Middleware\RequirePassword::class,
            // 'precognitive' => \Illuminate\Foundation\Http\Middleware\HandlePrecognitiveRequests::class,
            'signed' => \Illuminate\Routing\Middleware\ValidateSignature::class,
            'throttle' => \App\Http\Middleware\ThrottleRequests::class,
            'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
            'restrict' => \App\Http\Middleware\RestrictContent::class,
            'loginIp' => \App\Http\Middleware\LoginIpMiddleware::class,
        ]);

        $middleware->redirectGuestsTo(fn ($request) => $request->expectsJson() ? null : route('login'));
    })
    ->withExceptions(function (Exceptions $exceptions) {
        // Sentrty error reporting
        $exceptions->reportable(function (Throwable $e) {
            Integration::captureUnhandledException($e);
        });
    })->create();
