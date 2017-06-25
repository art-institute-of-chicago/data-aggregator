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
    Route::get('artworks/{artwork}', 'ArtworksController@show');
    Route::get('artworks/{artwork}/artists', 'ArtistsController@index');
    Route::get('artworks/{artwork}/copyrightRepresentatives', 'CopyrightRepresentativesController@index');
    Route::get('artworks/{artwork}/categories', 'CategoriesController@index');
    Route::get('artworks/{setId}/parts', 'ArtworksController@index');
    Route::get('artworks/{partId}/sets', 'ArtworksController@index');
    Route::get('artworks/{partId}/images', 'ImagesController@index');

    Route::get('agents', 'AgentsController@index');
    Route::get('agents/{agent}', 'AgentsController@show');
    Route::get('artists', 'ArtistsController@index');
    Route::get('artists/{artist}', 'ArtistsController@show');
    Route::get('venues', 'VenuesController@index');
    Route::get('venues/{venue}', 'VenuesController@show');

    Route::get('departments', 'DepartmentsController@index');
    Route::get('departments/{department}', 'DepartmentsController@show');

    Route::get('object-types', 'ObjectTypesController@index');
    Route::get('object-types/{objectType}', 'ObjectTypesController@show');

    Route::get('categories', 'CategoriesController@index');
    Route::get('categories/{category}', 'CategoriesController@show');

    Route::get('agent-types', 'AgentTypesController@index');
    Route::get('agent-types/{agentType}', 'AgentTypesController@show');

    Route::get('galleries', 'GalleriesController@index');
    Route::get('galleries/{gallery}', 'GalleriesController@show');

    Route::get('exhibitions', 'ExhibitionsController@index');
    Route::get('exhibitions/{exhibition}', 'ExhibitionsController@show');
    Route::get('exhibitions/{exhibition}/artworks', 'ArtworksController@index');
    Route::get('exhibitions/{exhibition}/venues', 'AgentsController@index');

    Route::get('images', 'ImagesController@index');
    Route::get('images/{image}', 'ImagesController@show');
    Route::get('videos', 'VideosController@index');
    Route::get('videos/{video}', 'VideosController@show');
    Route::get('links', 'LinksController@index');
    Route::get('links/{link}', 'LinksController@show');
    Route::get('sounds', 'SoundsController@index');
    Route::get('sounds/{sound}', 'SoundsController@show');
    Route::get('texts', 'TextsController@index');
    Route::get('texts/{text}', 'TextsController@show');

    Route::get('shop-categories', 'ShopCategoriesController@index');
    Route::get('shop-categories/{shopCategory}', 'ShopCategoriesController@show');

    Route::get('products', 'ProductsController@index');
    Route::get('products/{product}', 'ProductsController@show');

});
