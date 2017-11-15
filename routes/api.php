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

Route::get('/', function () {
    return redirect('/api/v1');
});


Route::group(['prefix' => 'v1'], function()
{

    Route::get('/', function () {
        return redirect('/api/v1/swagger.json');
    });

    Route::get('swagger.json', function() {
        return response(view('swagger', ['host' => parse_url(config('app.url'), PHP_URL_HOST)]), 200, ['Content-Type' => 'application/json']);
    });

    // Elasticsearch
    Route::match( array('GET', 'POST'), 'search', 'Search\SearchController@search');
    Route::match( array('GET', 'POST'), '{type}/search', 'Search\SearchController@search');
    // We can do ->where('type', '(foo|bar)') to limit {type}, but it's not necessary...

    Route::match( array('GET', 'POST'), 'autocomplete', 'Search\SearchController@autocomplete');
    // We can't limit autocomplete to specific types w/o creating additional type-specific suggest fields

    // ...following Elasticsearch conventions
    Route::match( array('GET', 'POST'), '_search', 'Search\SearchController@search');
    Route::match( array('GET', 'POST'), '{type}/_search', 'Search\SearchController@search');


    // Artwork related stuff
    Route::get('artworks', 'ArtworksController@index');
    Route::get('artworks/essentials', 'ArtworksController@essentials');

    Route::get('artworks/{id}', 'ArtworksController@show');
    Route::get('artworks/{id}/parts', 'ArtworksController@parts');
    Route::get('artworks/{id}/sets', 'ArtworksController@sets');

    Route::get('artworks/{id}/images', 'ImagesController@forArtwork');
    Route::get('artworks/{id}/artists', 'ArtistsController@forArtwork');
    Route::get('artworks/{id}/categories', 'CategoriesController@forArtwork');
    Route::get('artworks/{id}/departments', 'DepartmentsController@forArtwork'); // TODO: Unknown formatter "getKeyName"
    Route::get('artworks/{id}/copyrightRepresentatives', 'CopyrightRepresentativesController@forArtwork');

    // Collections
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
    Route::get('exhibitions/{id}/artworks', 'ArtworksController@forExhibition');
    Route::get('exhibitions/{id}/venues', 'VenuesController@forExhibition');

    Route::get('assets', 'AssetsController@index');
    Route::get('assets/{id}', 'AssetsController@show');
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

    // Shop
    Route::get('shop-categories', 'ShopCategoriesController@index');
    Route::get('shop-categories/{id}', 'ShopCategoriesController@show');

    Route::get('products', 'ProductsController@index');
    Route::get('products/{id}', 'ProductsController@show');

    // Membership/Events
    Route::get('events', 'EventsController@index');
    Route::get('events/{id}', 'EventsController@show');

    Route::get('members/{id}', 'MembersController@show');

    // Mobile App
    Route::get('tours', 'ToursController@index');
    Route::get('tours/{id}', 'ToursController@show');

    Route::get('tour-stops', 'TourStopsController@index');
    Route::get('tour-stops/{id}', 'TourStopsController@show');

    Route::get('mobile-sounds', 'MobileSoundsController@index');
    Route::get('mobile-sounds/{id}', 'MobileSoundsController@show');

    //DSC
    Route::get('publications', 'PublicationsController@index');
    Route::get('publications/{id}', 'PublicationsController@show');

    Route::get('sections', 'SectionsController@index');
    Route::get('sections/{id}', 'SectionsController@show');

    Route::get('sites', 'SitesController@index');
    Route::get('sites/{id}', 'SitesController@show');

});
