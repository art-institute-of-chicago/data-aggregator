<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ResourceController;
use App\Http\Controllers\RestrictedResourceController;
use App\Http\Controllers\CsvSearchController;

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
    // Elasticsearch
    Route::match(['GET', 'POST'], 'search', [CsvSearchController::class, 'search']);
    Route::match(['GET', 'POST'], '{resource}/search', [CsvSearchController::class, 'search']);

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
});
