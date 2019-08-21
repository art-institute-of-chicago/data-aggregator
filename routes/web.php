<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::any('/', function () {
    return redirect('/home');
});

Route::group(['middleware' => ['checkIp']], function() {
    Auth::routes();
});

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/docs/endpoints', 'EndpointsController@index')->name('doc-endpoints');
Route::get('/docs/fields', 'FieldsController@index')->name('doc-fields');

Route::get('/assets/{filename}', function ($filename) {
    $content = Storage::disk('local')->get($filename);
    \Debugbar::disable();
    return $content;
})->where('filename', '[a-zA-Z0-9\/\.]+');

Route::middleware('auth')->get('/user', function () {
    return Auth::user();
});
