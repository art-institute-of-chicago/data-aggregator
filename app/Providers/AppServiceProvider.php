<?php

namespace App\Providers;

use App\Services\EmbeddingService;
use App\Services\DescriptionService;
use Illuminate\Database\Eloquent\Relations\Relation;
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
