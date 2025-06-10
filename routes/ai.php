<?php

use App\Http\Controllers\AzureAIController;

/*
|--------------------------------------------------------------------------
| AI Routes
|--------------------------------------------------------------------------
|
| Here is where you can register AI routes for your application. These
| routes provide extra metadata about our models provided by AI anlysis,
| and will be assigned to the "ai.service.status" middleware group. Have fun!
|
*/

app('url')->forceRootUrl(config('aic.proxy_url'));
app('url')->forceScheme(config('aic.proxy_scheme'));

Route::group(['prefix' => 'v1'], function () {
    Route::any('/', [AzureAIController::class, 'show']);

    // Semantic search
    Route::get('{model}/search', [AzureAIController::class, 'semanticSearch']);

    // Nearest neighbor search
    Route::get('{model}/{id}/nearest', [AzureAIController::class, 'nearestNeighbor']);

    // Similarity search
    Route::get('{model}/{id}/similarity/{compareId}', [AzureAIController::class, 'similarity']);

    // Get single item with embeddings
    Route::get('{model}/{id}', [AzureAIController::class, 'getItem']);

    // Custom image search for visually similar embeddings
    Route::post('custom/nearest', [AzureAIController::class, 'findImageNearestNeighbors']);
});
