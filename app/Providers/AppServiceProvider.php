<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Schema;
use App\Http\Transformers\ApiSerializer;
use ScoutEngines\Elasticsearch\ElasticsearchEngine;
use Laravel\Scout\EngineManager;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        // Provide methods for API transformers
        $fractal = $this->app->make('League\Fractal\Manager');

        $fractal->setSerializer(new ApiSerializer);

        if (isset($_GET['include'])) {
            $fractal->parseIncludes($_GET['include']);
        }

        response()->macro('item', function ($item, \League\Fractal\TransformerAbstract $transformer, $status = 200, array $headers = []) use ($fractal) {
            $resource = new \League\Fractal\Resource\Item($item, $transformer);

            return response()->json(
                $fractal->createData($resource)->toArray(),
                $status,
                $headers
            );
        });

        response()->macro('collection', function ($collection, \League\Fractal\TransformerAbstract $transformer, $status = 200, array $headers = []) use ($fractal) {
            $resource = new \League\Fractal\Resource\Collection($collection, $transformer);

            $data = $fractal->createData($resource)->toArray();

            if ($collection instanceof LengthAwarePaginator)
            {

                $paginator = [
                    'total' => $collection->total(),
                    'limit' => (int) $collection->perPage(),
                    'offset' => (int) $collection->perPage() * ( $collection->currentPage() - 1 ),
                    'total_pages' => $collection->lastPage(),
                    'current_page' => $collection->currentPage(),
                ];
                if ($collection->previousPageUrl()) {
                    $paginator['prev_url'] = $collection->previousPageUrl() .'&limit=' .$collection->perPage();
                }
                if ($collection->hasMorePages()) {
                    $paginator['next_url'] = $collection->nextPageUrl() .'&limit=' .$collection->perPage();
                }

                $data = array_merge(['pagination' => $paginator], $data);

            }
            return response()->json(
                $data,
                $status,
                $headers
            );
        });

        response()->macro('error', function ($message, $detail, $status = 200) {
            return response()->json([
                'status' => $status,
                'error' => $message,
                'detail' => $detail,
            ], $status);
        });

        // MySQL compatibility
        Schema::defaultStringLength(191);

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

        $this->app->singleton(\Solarium\Client::class, function ($app) {
            // First endpoint is used by default
            return new \Solarium\Client( config('solarium') );
        });

    }
}
