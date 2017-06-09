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

Route::group(['prefix' => 'v1'], function()
{

    Route::any('/artworks', 'ArtworksController@respondMethodNotAllowed');
    Route::get('/artworks', 'ArtworksController@index');

    Route::any('/artworks/{artwork}', 'ArtworksController@respondMethodNotAllowed');
    Route::get('/artworks/{artwork}', 'ArtworksController@show');

    Route::any('/artworks/{artwork}/artist', 'ArtworksController@respondMethodNotAllowed');
    Route::get('/artworks/{artwork}/artist', 'ArtistsController@index');

    Route::any('/artworks/{artwork}/department', 'ArtworksController@respondMethodNotAllowed');
    Route::get('/artworks/{artwork}/department', 'DepartmentsController@index');

    Route::resource('/artists', 'ArtistsController', ['only' => ['index', 'show']]);
    Route::resource('/departments', 'DepartmentsController', ['only' => ['index', 'show']]);

});
