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

    Route::get('swagger.json', function() {
        return response(view('swagger', ['host' => config('app.url')]), 200, ['Content-Type' => 'application/json']);
    });

    Route::get('artworks', 'ArtworksController@index');
    Route::get('artworks/{id}', 'ArtworksController@show');
    Route::get('artworks/{id}/artists', 'ArtistsController@index');
    Route::get('artworks/{id}/copyrightRepresentatives', 'CopyrightRepresentativesController@index');
    Route::get('artworks/{id}/categories', 'CategoriesController@index');
    Route::get('artworks/{id}/parts', 'ArtworksController@index');
    Route::get('artworks/{id}/sets', 'ArtworksController@index');
    Route::get('artworks/{id}/images', 'ImagesController@index');

    Route::get('agents', 'AgentsController@index');
    Route::get('agents/{id}', 'AgentsController@show');
    Route::get('artists', 'ArtistsController@index');
    Route::get('artists/{id}', 'ArtistsController@show');
    Route::get('venues', 'VenuesController@index');
    Route::get('venues/{id}', 'VenuesController@show');

    Route::get('departments', 'DepartmentsController@index');
    Route::get('departments/{id}', 'DepartmentsController@show');

    Route::get('object-types', 'ObjectTypesController@index');
    Route::get('object-types/{id}', 'ObjectTypesController@show');

    Route::get('categories', 'CategoriesController@index');
    Route::get('categories/{id}', 'CategoriesController@show');

    Route::get('agent-types', 'AgentTypesController@index');
    Route::get('agent-types/{id}', 'AgentTypesController@show');

    Route::get('galleries', 'GalleriesController@index');
    Route::get('galleries/{id}', 'GalleriesController@show');

    Route::get('exhibitions', 'ExhibitionsController@index');
    Route::get('exhibitions/{id}', 'ExhibitionsController@show');
    Route::get('exhibitions/{id}/artworks', 'ArtworksController@index');
    Route::get('exhibitions/{id}/venues', 'AgentsController@index');

    Route::get('images', 'ImagesController@index');
    Route::get('images/{id}', 'ImagesController@show');
    Route::get('videos', 'VideosController@index');
    Route::get('videos/{id}', 'VideosController@show');
    Route::get('links', 'LinksController@index');
    Route::get('links/{id}', 'LinksController@show');
    Route::get('sounds', 'SoundsController@index');
    Route::get('sounds/{id}', 'SoundsController@show');
    Route::get('texts', 'TextsController@index');
    Route::get('texts/{id}', 'TextsController@show');

    Route::get('shop-categories', 'ShopCategoriesController@index');
    Route::get('shop-categories/{id}', 'ShopCategoriesController@show');

    Route::get('products', 'ProductsController@index');
    Route::get('products/{id}', 'ProductsController@show');

    Route::get('events', 'EventsController@index');
    Route::get('events/{id}', 'EventsController@show');

});
