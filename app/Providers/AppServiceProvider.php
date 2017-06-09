<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $fractal = $this->app->make('League\Fractal\Manager');

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

            $paginator = [
                'total' => $collection->total(),
                'limit' => (int) $collection->perPage(),
                'offset' => $collection->currentPage() - 1,
                'total_pages' => $collection->lastPage(),
                'current_page' => $collection->currentPage(),
            ];
            if ($collection->previousPageUrl()) {
                $paginator['prev_url'] = $collection->previousPageUrl() .'&limit=' .$collection->perPage();
            }
            if ($collection->hasMorePages()) {
                $paginator['next_url'] = $collection->nextPageUrl() .'&limit=' .$collection->perPage();
            }
            return response()->json(
                array_merge(['pagination' => $paginator], $fractal->createData($resource)->toArray()),
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

        
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
