<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ResourceController;
use App\Http\Controllers\RestrictedResourceController;
use App\Http\Controllers\OpenapiController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ImageSearchController;
use App\Http\Controllers\ArtworkController;
use App\Http\Controllers\AssetController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

app('url')->forceRootUrl(config('aic.proxy_url'));
app('url')->forceScheme(config('aic.proxy_scheme'));

Route::group(['prefix' => 'v1'], function () {
    Route::any('/', function () {
        return redirect('/api/v1/openapi.json');
    });

    Route::any('openapi.json', [OpenapiController::class, 'index'])->name('doc-openapi');
    Route::any('swagger.json', fn () => redirect()->route('doc-openapi'));

    // Elasticsearch
    Route::match(['GET', 'POST'], 'search', [SearchController::class, 'search']);
    Route::match(['GET', 'POST'], '{resource}/search', [SearchController::class, 'search']);

    Route::match(['GET', 'POST'], '{resource}/search-mapping', [SearchController::class, 'searchMapping']);

    Route::match(['GET', 'POST'], 'msearch', [SearchController::class, 'msearch']);
    Route::match(['GET', 'POST'], 'msuggest', [SearchController::class, 'msuggest']);

    Route::match(['GET', 'POST'], 'autocomplete', [SearchController::class, 'autocompleteWithTitle']);
    Route::match(['GET', 'POST'], 'autosuggest', [SearchController::class, 'autocompleteWithSource']);

    // Image search
    Route::match(['GET', 'POST'], 'image-search', [ImageSearchController::class, 'imageSearch']);

    // For debugging search, show generated request
    if (env('APP_ENV') === 'local') {
        Route::match(['GET', 'POST'], 'echo', [SearchController::class, 'echo']);
        Route::match(['GET', 'POST'], '{resource}/echo', [SearchController::class, 'echo']);
        Route::match(['GET', 'POST'], '{resource}/{id}/explain', [SearchController::class, 'explain']);
    }

    // Define all of our resource routes by looping through config
    foreach (config('resources.outbound.base') as $resource) {
        if (!isset($resource['endpoint'])) {
            continue;
        }

        $isScoped = $resource['scope_of'] ?? false;
        $isRestricted = $resource['is_restricted'] ?? false;

        $controller = $resource['controller'] ?? (
            ($isRestricted && env('APP_ENV') !== 'testing') ? RestrictedResourceController::class : ResourceController::class
        );

        Route::any($resource['endpoint'], [$controller, ($isScoped ? 'indexScope' : 'index')]);
        Route::any($resource['endpoint'] . '/{id}', [$controller, ($isScoped ? 'showScope' : 'show')]);
    }

    // WEB-1809: Add manifests to support IIIF Presentation API
    Route::any('artworks/{id}/manifest', [ArtworkController::class, 'manifest']);
    Route::any('artworks/{id}/manifest.json', [ArtworkController::class, 'manifest']);

    Route::any('netx/{id}', [AssetController::class, 'netx']);
});
