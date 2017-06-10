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

    Route::any('artworks', 'ApiController@respondMethodNotAllowed');
    Route::get('artworks', 'ArtworksController@index');

    Route::any('artworks/{artwork}', 'ApiController@respondMethodNotAllowed');
    Route::get('artworks/{artwork}', 'ArtworksController@show');

    Route::any('artworks/{artwork}/artist', 'ApiController@respondMethodNotAllowed');
    Route::get('artworks/{artwork}/artist', 'ArtistsController@index');

    Route::any('artworks/{artwork}/department', 'ApiController@respondMethodNotAllowed');
    Route::get('artworks/{artwork}/department', 'DepartmentsController@index');

    Route::any('artworks/{artwork}/categories', 'ApiController@respondMethodNotAllowed');
    Route::get('artworks/{artwork}/categories', 'CategoriesController@index');


    Route::any('artists', 'ApiController@respondMethodNotAllowed');
    Route::get('artists', 'ArtistsController@index');


    Route::any('departments', 'ApiController@respondMethodNotAllowed');
    Route::get('departments', 'DepartmentsController@index');


    Route::any('categories', 'ApiController@respondMethodNotAllowed');
    Route::get('categories', 'CategoriesController@index');

});
