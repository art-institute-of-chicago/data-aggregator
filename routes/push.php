<?php

app('url')->forceRootUrl(config('aic.proxy_url'));
app('url')->forceScheme(config('aic.proxy_scheme'));

use App\Http\Controllers\ProductController;

Route::group(['prefix' => 'v1'], function () {
    Route::post('products', [ProductController::class, 'upload']);
});
