<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Sentry\Laravel\Integration;
use Aic\Hub\Foundation\Exceptions\AbstractException;
use Aic\Hub\Foundation\Exceptions\UnauthorizedException;
use Illuminate\Auth\AuthenticationException;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
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
        $FOR_ONE_YEAR = 525600;

        $schedule->command('report:category-terms')
            ->dailyAt('20:00')
            ->withoutOverlapping()
            ->sentryMonitor();

        $schedule->command('cache:prune-stale-tags')
            ->hourly()
            ->sentryMonitor();

        $schedule->command('update:cloudfront-ips')
            ->hourly()
            ->sentryMonitor();

        //
        // Mobile app
        $schedule->command('import:mobile')
            ->dailyAt('23:05')
            ->withoutOverlapping($FOR_ONE_YEAR)
            ->sentryMonitor();

        //
        // Shop
        $schedule->command('import:products-full', ['--yes'])
            ->dailyAt('23:10')
            ->withoutOverlapping($FOR_ONE_YEAR)
            ->sentryMonitor();

        //
        // Website
        $schedule->command('import:web-full', ['articles', '--yes'])
            ->dailyAt('23:15')
            ->withoutOverlapping($FOR_ONE_YEAR)
            ->sentryMonitor();

        $schedule->command('import:web-full', ['artworks', '--yes'])
            ->dailyAt('23:18')
            ->withoutOverlapping($FOR_ONE_YEAR)
            ->sentryMonitor();

        $schedule->command('import:web-full', ['artists', '--yes'])
            ->dailyAt('23:21')
            ->withoutOverlapping($FOR_ONE_YEAR)
            ->sentryMonitor();

        $schedule->command('import:web-full', ['events', '--yes'])
            ->dailyAt('23:24')
            ->withoutOverlapping($FOR_ONE_YEAR)
            ->sentryMonitor();

        $schedule->command('import:web-full', ['event-occurrences', '--yes'])
            ->dailyAt('23:27')
            ->withoutOverlapping($FOR_ONE_YEAR)
            ->sentryMonitor();

        $schedule->command('import:web-full', ['event-programs', '--yes'])
            ->dailyAt('23:30')
            ->withoutOverlapping($FOR_ONE_YEAR)
            ->sentryMonitor();

        $schedule->command('import:web-full', ['exhibitions', '--yes'])
            ->dailyAt('23:33')
            ->withoutOverlapping($FOR_ONE_YEAR)
            ->sentryMonitor();

        $schedule->command('import:web-full', ['highlights', '--yes'])
            ->dailyAt('23:36')
            ->withoutOverlapping($FOR_ONE_YEAR)
            ->sentryMonitor();

        $schedule->command('import:web-full', ['genericpages', '--yes'])
            ->dailyAt('23:39')
            ->withoutOverlapping($FOR_ONE_YEAR)
            ->sentryMonitor();

        $schedule->command('import:web-full', ['pressreleases', '--yes'])
            ->dailyAt('23:42')
            ->withoutOverlapping($FOR_ONE_YEAR)
            ->sentryMonitor();

        $schedule->command('import:web-full', ['educatorresources', '--yes'])
            ->dailyAt('23:45')
            ->withoutOverlapping($FOR_ONE_YEAR)
            ->sentryMonitor();

        $schedule->command('import:web-full', ['digitalpublications', '--yes'])
            ->dailyAt('23:48')
            ->withoutOverlapping($FOR_ONE_YEAR)
            ->sentryMonitor();

        $schedule->command('import:web-full', ['digitalpublicationarticles', '--yes'])
            ->dailyAt('23:51')
            ->withoutOverlapping($FOR_ONE_YEAR)
            ->sentryMonitor();

        $schedule->command('import:web-full', ['printedpublications', '--yes'])
            ->dailyAt('23:54')
            ->withoutOverlapping($FOR_ONE_YEAR)
            ->sentryMonitor();

        $schedule->command('import:web-full', ['staticpages', '--yes'])
            ->dailyAt('23:57')
            ->withoutOverlapping($FOR_ONE_YEAR)
            ->sentryMonitor();

        $schedule->command('import:web-full', ['hours', '--yes'])
            ->everyFiveMinutes()
            ->withoutOverlapping($FOR_ONE_YEAR)
            ->sentryMonitor();

        $schedule->command('import:web')
            ->everyFiveMinutes()
            ->withoutOverlapping($FOR_ONE_YEAR)
            ->sentryMonitor();

        $schedule->command('ai:embed-description')
            ->everyMinute()
            ->withoutOverlapping($FOR_ONE_YEAR)
            ->sentryMonitor();

        //
        // Archived Static sites
        $schedule->command('import:sites', ['--yes'])
            ->monthlyOn(1, '03:00')
            ->sentryMonitor();

        //
        // Archival materials from Alma/Primo
        if (!App::environment('production')) {
            $schedule->command('import:archives', ['--yes'])
                ->dailyAt('23:08')
                ->withoutOverlapping($FOR_ONE_YEAR)
                ->sentryMonitor();
        }

        //
        // Digital scholarly catalogues
        $schedule->command('import:dsc', ['--yes'])
            ->monthlyOn(1, '03:05')
            ->sentryMonitor();

        //
        // Google Analytics
        $schedule->command('import:analytics')
            ->monthlyOn(1, '03:10')
            ->sentryMonitor();

        //
        // Ticketed events
        $schedule->command('import:events-ticketed-full', ['--unreset'])
            ->everyFiveMinutes()
            ->withoutOverlapping($FOR_ONE_YEAR)
            ->sentryMonitor();

        //
        // Collections and DAMS
        $schedule->command('delete:assets')
            ->everyFiveMinutes()
            ->withoutOverlapping($FOR_ONE_YEAR)
            ->sentryMonitor();

        $schedule->command('delete:collections')
            ->everyFiveMinutes()
            ->withoutOverlapping($FOR_ONE_YEAR)
            ->sentryMonitor();

        $schedule->command('import:assets')
            ->everyFiveMinutes()
            ->withoutOverlapping($FOR_ONE_YEAR)
            ->sentryMonitor();

        $schedule->command('import:collections')
            ->everyFiveMinutes()
            ->withoutOverlapping($FOR_ONE_YEAR)
            ->sentryMonitor();

        //
        // Virtual lines
        $schedule->command('import:queues')
            ->everyMinute()
            ->withoutOverlapping($FOR_ONE_YEAR)
            ->sentryMonitor();

        //
        // Data enhancer
        $schedule->command('import:enhancer')
            ->everyMinute()
            ->withoutOverlapping($FOR_ONE_YEAR)
            ->sentryMonitor();

        if (!App::environment('production')) {
            $schedule->command('import:artist-enrichment')
                ->hourly()
                ->withoutOverlapping($FOR_ONE_YEAR)
                ->sentryMonitor();
        }

        // API-231, API-232: Temporary remediation! Artworks can't touch artists.
        $schedule->command('scout:import', [
            \App\Models\Collections\Agent::class,
        ])
            ->hourly()
            ->withoutOverlapping($FOR_ONE_YEAR)
            ->sentryMonitor();

        // API-401: Make sure the artworks index is always in sync with the datebase
        $schedule->command('scout:import', [
            \App\Models\Collections\Artwork::class,
        ])
            ->dailyAt('22:10')
            ->withoutOverlapping($FOR_ONE_YEAR)
            ->sentryMonitor();

        if (config('aic.dump.schedule_enabled')) {
            $schedule->command('dump:schedule')
                ->weekly()
                ->sundays()
                ->withoutOverlapping($FOR_ONE_YEAR)
                ->sentryMonitor();
        }
    })->create();
