<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\Facades\Route;
use Sentry\Laravel\Integration;
use Aic\Hub\Foundation\Exceptions\AbstractException;
use Aic\Hub\Foundation\Exceptions\UnauthorizedException;
use Illuminate\Auth\AuthenticationException;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
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
    ->withMiddleware(function (Middleware $middleware): void {
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
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        // Always render JSON for API routes, regardless of the request's Accept header
        $exceptions->shouldRenderJsonWhen(
            fn (Request $request) => $request->is('api/*') || $request->expectsJson(),
        );

        // Avoid redirecting to a nonexistent `login` route on unauthenticated API requests
        $exceptions->map(AuthenticationException::class, fn () => new UnauthorizedException());

        // Render our own exceptions (and any other exception once debugging is off) using
        // our API's standard {status, error, detail} shape instead of Laravel's default
        // error page/stack trace dump
        $exceptions->render(function (Throwable $e, $request) {
            if (!$request->is('api/*') && !$request->expectsJson()) {
                return null;
            }

            $isDetailed = $e instanceof AbstractException;

            // Laravel's debug page is too useful to forgo for genuinely unexpected errors
            if (config('app.debug') && !$isDetailed) {
                return null;
            }

            $status = $e instanceof HttpExceptionInterface ? $e->getStatusCode() : 500;

            $response = [
                'status' => $status,
                'error' => 'Sorry, something went wrong.',
                'detail' => 'An unrecognized exception was thrown. Our developers have been alerted to the situation.',
            ];

            if ($isDetailed) {
                $response['error'] = $e->getMessage();
                $response['detail'] = $e->getDetail();
            }

            return response()->json($response, $status);
        });

        // Sentry error reporting
        $exceptions->reportable(function (Throwable $e) {
            Integration::captureUnhandledException($e);
        });
    })
    ->withSchedule(function (Schedule $schedule): void {
        $schedule->command('report:category-terms')
            ->dailyAt('20:00')
            ->withoutOverlapping();
    })->create();
