<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

app('url')->forceRootUrl(config('aic.proxy_url'));
app('url')->forceScheme(config('aic.proxy_scheme'));

Route::group(['prefix' => 'v1'], function () {

    Route::any('/', function () {
        return redirect('/api/v1/swagger.json');
    });

    Route::any('swagger.json', 'SwaggerController@index')->name('doc-swagger');

    // Elasticsearch
    Route::match(['GET', 'POST'], 'search', 'SearchController@search');
    Route::match(['GET', 'POST'], '{resource}/search', 'SearchController@search');

    Route::match(['GET', 'POST'], 'msearch', 'SearchController@msearch');
    Route::match(['GET', 'POST'], 'msuggest', 'SearchController@msuggest');

    Route::match(['GET', 'POST'], 'autocomplete', 'SearchController@autocompleteWithTitle');
    Route::match(['GET', 'POST'], 'autosuggest', 'SearchController@autocompleteWithSource');

    // For debugging search, show generated request
    if (env('APP_ENV') === 'local') {
        Route::match(['GET', 'POST'], 'echo', 'SearchController@echo');
        Route::match(['GET', 'POST'], '{resource}/echo', 'SearchController@echo');
        Route::match(['GET', 'POST'], '{resource}/{id}/explain', 'SearchController@explain');
    }

    // Define all of our resource routes by looping through config
    foreach (config('resources.outbound.base') as $resource) {
        if (!isset($resource['endpoint'])) {
            continue;
        }

        $isScoped = $resource['scope_of'] ?? false;
        $isRestricted = $resource['is_restricted'] ?? false;

        $controller = $resource['controller'] ?? (
            $isRestricted ? 'RestrictedResourceController' : 'ResourceController'
        );

        Route::any($resource['endpoint'], $controller . '@' . ($isScoped ? 'indexScope' : 'index'));
        Route::any($resource['endpoint'] . '/{id}', $controller . '@' . ($isScoped ? 'showScope' : 'show'));
    }

    // WEB-1809: Add manifests to support IIIF Presentation API
    Route::any('artworks/{id}/manifest', 'ArtworkController@manifest');
    Route::any('artworks/{id}/manifest.json', 'ArtworkController@manifest');
});
