<?php

namespace App\Providers;

use App\Services\EmbeddingService;
use App\Services\DescriptionService;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Http\Request;
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

        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
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
