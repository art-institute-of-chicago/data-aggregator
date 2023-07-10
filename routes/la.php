<?php

use App\Http\Controllers\LinkedArtController;
use App\Http\Controllers\LinkedArtSearchController;

app('url')->forceRootUrl(config('aic.proxy_url'));
app('url')->forceScheme(config('aic.proxy_scheme'));

Route::group(['prefix' => 'v1'], function () {
    Route::match(['GET', 'POST'], 'objects/search', [LinkedArtSearchController::class, 'search'])->name('la.objects.search');
    Route::get('objects/{id}', [LinkedArtController::class, 'showObject'])->name('ld.object');
    Route::get('objects', [LinkedArtController::class, 'showMultiple'])->name('ld.objects');
});
