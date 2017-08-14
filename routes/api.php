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
        return response(view('swagger', ['host' => parse_url(config('app.url'), PHP_URL_HOST)]), 200, ['Content-Type' => 'application/json']);
    });

    // Elasticsearch
    // TODO: Namespace the route? e.g. es/search
    Route::get('search', 'Search\SearchController@search');
    Route::get('autocomplete', 'Search\SearchController@autocomplete');

    // Collections
    Route::get('artworks', 'ArtworksController@index');
    Route::get('artworks/essentials', 'ArtworksController@index');
    Route::get('artworks/search', 'Search\SearchController@search');
    Route::get('artworks/{id}', 'ArtworksController@show');
    Route::get('artworks/{id}/artists', 'ArtistsController@index');
    Route::get('artworks/{id}/copyrightRepresentatives', 'CopyrightRepresentativesController@index');
    Route::get('artworks/{id}/categories', 'CategoriesController@index');
    Route::get('artworks/{id}/parts', 'ArtworksController@index');
    Route::get('artworks/{id}/sets', 'ArtworksController@index');
    Route::get('artworks/{id}/images', 'ImagesController@index');

    Route::get('agents', 'AgentsController@index');
    Route::get('agents/search', 'Search\SearchController@search');
    Route::get('agents/{id}', 'AgentsController@show');
    Route::get('artists', 'ArtistsController@index');
    Route::get('artists/{id}', 'ArtistsController@show');
    Route::get('venues', 'VenuesController@index');
    Route::get('venues/{id}', 'VenuesController@show');

    Route::get('departments', 'DepartmentsController@index');
    Route::get('departments/search', 'Search\SearchController@search');
    Route::get('departments/{id}', 'DepartmentsController@show');

    Route::get('object-types', 'ObjectTypesController@index');
    Route::get('object-types/{id}', 'ObjectTypesController@show');

    Route::get('categories', 'CategoriesController@index');
    Route::get('categories/search', 'Search\SearchController@search');
    Route::get('categories/{id}', 'CategoriesController@show');

    Route::get('agent-types', 'AgentTypesController@index');
    Route::get('agent-types/{id}', 'AgentTypesController@show');

    Route::get('galleries', 'GalleriesController@index');
    Route::get('galleries/search', 'Search\SearchController@search');
    Route::get('galleries/{id}', 'GalleriesController@show');

    Route::get('exhibitions', 'ExhibitionsController@index');
    Route::get('exhibitions/search', 'Search\SearchController@search');
    Route::get('exhibitions/{id}', 'ExhibitionsController@show');
    Route::get('exhibitions/{id}/artworks', 'ArtworksController@index');
    Route::get('exhibitions/{id}/venues', 'AgentsController@index');

    Route::get('images', 'ImagesController@index');
    Route::get('images/{id}', 'ImagesController@show');
    Route::get('videos', 'VideosController@index');
    Route::get('videos/search', 'Search\SearchController@search');
    Route::get('videos/{id}', 'VideosController@show');
    Route::get('links', 'LinksController@index');
    Route::get('links/search', 'Search\SearchController@search');
    Route::get('links/{id}', 'LinksController@show');
    Route::get('sounds', 'SoundsController@index');
    Route::get('sounds/search', 'Search\SearchController@search');
    Route::get('sounds/{id}', 'SoundsController@show');
    Route::get('texts', 'TextsController@index');
    Route::get('texts/search', 'Search\SearchController@search');
    Route::get('texts/{id}', 'TextsController@show');

    // Shop
    Route::get('shop-categories', 'ShopCategoriesController@index');
    Route::get('shop-categories/search', 'Search\SearchController@search');
    Route::get('shop-categories/{id}', 'ShopCategoriesController@show');

    Route::get('products', 'ProductsController@index');
    Route::get('products/search', 'Search\SearchController@search');
    Route::get('products/{id}', 'ProductsController@show');

    // Membership/Events
    Route::get('events', 'EventsController@index');
    Route::get('events/search', 'Search\SearchController@search');
    Route::get('events/{id}', 'EventsController@show');

    Route::get('members/{id}/{zip}', 'MembersController@show');

    // Mobile App
    Route::get('tours', 'ToursController@index');
    Route::get('tours/search', 'Search\SearchController@search');
    Route::get('tours/{id}', 'ToursController@show');

    Route::get('tour-stops', 'TourStopsController@index');
    Route::get('tour-stops/search', 'Search\SearchController@search');
    Route::get('tour-stops/{id}', 'TourStopsController@show');

    Route::get('mobile-sounds', 'MobileSoundsController@index');
    Route::get('mobile-sounds/{id}', 'MobileSoundsController@show');

    //DSC
    Route::get('publications', 'PublicationsController@index');
    Route::get('publications/search', 'Search\SearchController@search');
    Route::get('publications/{id}', 'PublicationsController@show');

    Route::get('title-pages', 'TitlePagesController@index');
    Route::get('title-pages/{id}', 'TitlePagesController@show');

    Route::get('sections', 'SectionsController@index');
    Route::get('sections/search', 'Search\SearchController@search');
    Route::get('sections/{id}', 'SectionsController@show');

    Route::get('works-of-art', 'WorksOfArtController@index');
    Route::get('works-of-art/search', 'Search\SearchController@search');
    Route::get('works-of-art/{id}', 'WorksOfArtController@show');

    Route::get('footnotes', 'FootnotesController@index');
    Route::get('footnotes/{id}', 'FootnotesController@show');

    Route::get('figures', 'FiguresController@index');
    Route::get('figures/{id}', 'FiguresController@show');

    Route::get('collectors', 'CollectorsController@index');
    Route::get('collectors/search', 'Search\SearchController@search');
    Route::get('collectors/{id}', 'CollectorsController@show');

    Route::get('sites', 'SitesController@index');
    Route::get('sites/search', 'Search\SearchController@search');
    Route::get('sites/{id}', 'SitesController@show');

});
