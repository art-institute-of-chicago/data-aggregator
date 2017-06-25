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

    Route::any('artworks', 'ApiController@respondMethodNotAllowed');
    Route::get('artworks', 'ArtworksController@index');

    Route::any('artworks/{artwork}', 'ApiController@respondMethodNotAllowed');
    Route::get('artworks/{artwork}', 'ArtworksController@show');

    Route::any('artworks/{artwork}/artists', 'ApiController@respondMethodNotAllowed');
    Route::get('artworks/{artwork}/artists', 'ArtistsController@index');

    Route::any('artworks/{artwork}/copyrightRepresentatives', 'ApiController@respondMethodNotAllowed');
    Route::get('artworks/{artwork}/copyrightRepresentatives', 'CopyrightRepresentativesController@index');

    Route::any('artworks/{artwork}/categories', 'ApiController@respondMethodNotAllowed');
    Route::get('artworks/{artwork}/categories', 'CategoriesController@index');

    Route::any('artworks/{setId}/parts', 'ApiController@respondMethodNotAllowed');
    Route::get('artworks/{setId}/parts', 'ArtworksController@index');

    Route::any('artworks/{partId}/sets', 'ApiController@respondMethodNotAllowed');
    Route::get('artworks/{partId}/sets', 'ArtworksController@index');

    Route::any('artworks/{partId}/images', 'ApiController@respondMethodNotAllowed');
    Route::get('artworks/{partId}/images', 'ImagesController@index');

    Route::any('agents', 'ApiController@respondMethodNotAllowed');
    Route::get('agents', 'AgentsController@index');

    Route::any('agents/{agent}', 'ApiController@respondMethodNotAllowed');
    Route::get('agents/{agent}', 'AgentsController@show');

    Route::any('artists', 'ApiController@respondMethodNotAllowed');
    Route::get('artists', 'ArtistsController@index');

    Route::any('artists/{artist}', 'ApiController@respondMethodNotAllowed');
    Route::get('artists/{artist}', 'ArtistsController@show');

    Route::any('venues', 'ApiController@respondMethodNotAllowed');
    Route::get('venues', 'VenuesController@index');

    Route::any('venues/{venue}', 'ApiController@respondMethodNotAllowed');
    Route::get('venues/{venue}', 'VenuesController@show');

    Route::any('departments', 'ApiController@respondMethodNotAllowed');
    Route::get('departments', 'DepartmentsController@index');

    Route::any('departments/{department}', 'ApiController@respondMethodNotAllowed');
    Route::get('departments/{department}', 'DepartmentsController@show');

    Route::any('object-types', 'ApiController@respondMethodNotAllowed');
    Route::get('object-types', 'ObjectTypesController@index');

    Route::any('object-types/{objectType}', 'ApiController@respondMethodNotAllowed');
    Route::get('object-types/{objectType}', 'ObjectTypesController@show');

    Route::any('categories', 'ApiController@respondMethodNotAllowed');
    Route::get('categories', 'CategoriesController@index');

    Route::any('categories/{category}', 'ApiController@respondMethodNotAllowed');
    Route::get('categories/{category}', 'CategoriesController@show');

    Route::any('agent-types', 'ApiController@respondMethodNotAllowed');
    Route::get('agent-types', 'AgentTypesController@index');

    Route::any('agent-types/{agentType}', 'ApiController@respondMethodNotAllowed');
    Route::get('agent-types/{agentType}', 'AgentTypesController@show');

    Route::any('galleries', 'ApiController@respondMethodNotAllowed');
    Route::get('galleries', 'GalleriesController@index');

    Route::any('galleries/{gallery}', 'ApiController@respondMethodNotAllowed');
    Route::get('galleries/{gallery}', 'GalleriesController@show');

    Route::any('exhibitions', 'ApiController@respondMethodNotAllowed');
    Route::get('exhibitions', 'ExhibitionsController@index');

    Route::any('exhibitions/{exhibition}', 'ApiController@respondMethodNotAllowed');
    Route::get('exhibitions/{exhibition}', 'ExhibitionsController@show');

    Route::any('exhibitions/{exhibition}/artworks', 'ApiController@respondMethodNotAllowed');
    Route::get('exhibitions/{exhibition}/artworks', 'ArtworksController@index');

    Route::any('exhibitions/{exhibition}/venues', 'ApiController@respondMethodNotAllowed');
    Route::get('exhibitions/{exhibition}/venues', 'AgentsController@index');

    Route::any('images', 'ApiController@respondMethodNotAllowed');
    Route::get('images', 'ImagesController@index');

    Route::any('images/{image}', 'ApiController@respondMethodNotAllowed');
    Route::get('images/{image}', 'ImagesController@show');

    Route::any('videos', 'ApiController@respondMethodNotAllowed');
    Route::get('videos', 'VideosController@index');

    Route::any('videos/{video}', 'ApiController@respondMethodNotAllowed');
    Route::get('videos/{video}', 'VideosController@show');

    Route::any('links', 'ApiController@respondMethodNotAllowed');
    Route::get('links', 'LinksController@index');

    Route::any('links/{link}', 'ApiController@respondMethodNotAllowed');
    Route::get('links/{link}', 'LinksController@show');

    Route::any('sounds', 'ApiController@respondMethodNotAllowed');
    Route::get('sounds', 'SoundsController@index');

    Route::any('sounds/{sound}', 'ApiController@respondMethodNotAllowed');
    Route::get('sounds/{sound}', 'SoundsController@show');

    Route::any('texts', 'ApiController@respondMethodNotAllowed');
    Route::get('texts', 'TextsController@index');

    Route::any('texts/{text}', 'ApiController@respondMethodNotAllowed');
    Route::get('texts/{text}', 'TextsController@show');

    Route::any('shop-categories', 'ApiController@respondMethodNotAllowed');
    Route::get('shop-categories', 'ShopCategoriesController@index');

    Route::any('shop-categories/{shopCategory}', 'ApiController@respondMethodNotAllowed');
    Route::get('shop-categories/{shopCategory}', 'ShopCategoriesController@show');

    Route::any('products', 'ApiController@respondMethodNotAllowed');
    Route::get('products', 'ProductsController@index');

    Route::any('products/{product}', 'ApiController@respondMethodNotAllowed');
    Route::get('products/{product}', 'ProductsController@show');

});
