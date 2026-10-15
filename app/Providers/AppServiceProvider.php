<?php

namespace App\Providers;

use App\Services\EmbeddingService;
use App\Services\DescriptionService;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Relation::morphMap([
            'artworks' => 'App\Models\Collections\Artwork',

            'articles' => 'App\Models\Web\Article',
            'highlights' => 'App\Models\Web\Highlight',
        ]);

        // WEB-1929: Throttle anonymous users by IP. Users with a valid token or a
        // whitelisted IP (or any user, if the app is unrestricted) are not throttled.
        RateLimiter::for('api', function (Request $request) {
            if (Gate::allows('restricted-access')) {
                return Limit::none();
            }

            $limits = [
                Limit::perMinute((int) config('aic.auth.max_attempts'))->by($request->ip()),
            ];

            // AI requests also count toward a stricter limit of their own. Keep it last
            // so its values are the ones reported in the X-RateLimit-* headers.
            if ($request->is('ai/*')) {
                $limits[] = Limit::perMinute((int) config('aic.auth.max_attempts_ai'))->by('ai|' . $request->ip());
            }

            return $limits;
        });
    }

    public function register(): void
    {
        $this->app->singleton('Embeddings', function () {
            return new EmbeddingService();
        });

        $this->app->singleton('Descriptions', function () {
            return new DescriptionService(new EmbeddingService());
        });
    }
}
