<?php

app('url')->forceRootUrl(config('aic.proxy_url'));
app('url')->forceScheme(config('aic.proxy_scheme'));

use App\Http\Controllers\LinkedArtController;

Route::group(['prefix' => 'v1'], function () {
    Route::get('artworks/{id}', [LinkedArtController::class, 'artwork'])->name('ld.artwork');
});
