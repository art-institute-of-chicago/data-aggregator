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


Route::group(['prefix' => 'v1'], function() {

    Route::get('/', function () {
        return redirect('/api/v1/swagger.json');
    });

    Route::get('swagger.json', function() {
        return response(view('swagger', ['host' => parse_url(config('app.url'), PHP_URL_HOST)]), 200, ['Content-Type' => 'application/json']);
    });

    // Elasticsearch
    Route::match( array('GET', 'POST'), 'search', 'Search\SearchController@search');
    Route::match( array('GET', 'POST'), '{resource}/search', 'Search\SearchController@search');
    // We can do ->where('resource', '(foo|bar)') to limit {resource}, but it's not necessary...

    Route::match( array('GET', 'POST'), 'msearch', 'Search\SearchController@msearch');

    Route::match( array('GET', 'POST'), 'autocomplete', 'Search\SearchController@autocomplete');

    // ...following Elasticsearch conventions
    // TODO: Deprecate these since we're not following ES conventions anymore?
    Route::match( array('GET', 'POST'), '_search', 'Search\SearchController@search');
    Route::match( array('GET', 'POST'), '{resource}/_search', 'Search\SearchController@search');

    // For debugging search, show generated request
    if( env('APP_ENV') === 'local' ) {
        Route::match( array('GET', 'POST'), 'echo', 'Search\SearchController@echo');
        Route::match( array('GET', 'POST'), '{resource}/echo', 'Search\SearchController@echo');
        Route::match( array('GET', 'POST'), '{resource}/{id}/explain', 'Search\SearchController@explain');
    }


    // Artwork related stuff
    Route::get('artworks', 'ArtworksController@index');
    Route::get('artworks/boosted', 'ArtworksController@boosted');

    Route::get('artworks/{id}', 'ArtworksController@show');
    Route::get('artworks/{id}/parts', 'ArtworksController@parts');
    Route::get('artworks/{id}/sets', 'ArtworksController@sets');

    Route::get('artworks/{id}/images', 'ImagesController@forArtwork');
    Route::get('artworks/{id}/categories', 'CategoriesController@forArtwork');

    Route::get('artworks/{id}/artists', 'AgentsController@scopeForArtwork');
    Route::get('artworks/{id}/copyright-representatives', 'AgentsController@scopeForArtwork');

    Route::get('artworks/{id}/terms', 'TermsController@forArtwork');

    Route::get('artworks/{id}/artwork-catalogues', 'ArtworkCataloguesController@forArtwork');

    // Collections
    Route::get('agents', 'AgentsController@index');
    Route::get('agents/boosted', 'AgentsController@boosted');
    Route::get('agents/{id}', 'AgentsController@show');
    Route::get('agents/{id}/places', 'AgentPlacesController@forAgent');
    Route::get('artists', 'AgentsController@indexScope');
    Route::get('artists/{id}', 'AgentsController@showScope');
    Route::get('venues', 'AgentExhibitionsController@index');
    Route::get('venues/{id}', 'AgentExhibitionsController@show');
    // Route::get('copyright-representatives', 'AgentsController@indexScope');
    Route::get('agent-places', 'AgentPlacesController@index');
    Route::get('agent-places/{id}', 'AgentPlacesController@show');

    Route::get('artwork-catalogues', 'ArtworkCataloguesController@index');
    Route::get('artwork-catalogues/{id}', 'ArtworkCataloguesController@show');

    Route::get('departments', 'CategoriesController@departments');
    Route::get('departments/{id}', 'CategoriesController@show');

    Route::get('artwork-types', 'ArtworkTypesController@index');
    Route::get('artwork-types/{id}', 'ArtworkTypesController@show');

    Route::get('categories', 'CategoriesController@index');
    Route::get('categories/{id}', 'CategoriesController@show');

    Route::get('category-terms', 'CategoryTermsController@index');
    Route::get('category-terms/{id}', 'CategoryTermsController@show');

    Route::get('agent-types', 'AgentTypesController@index');
    Route::get('agent-types/{id}', 'AgentTypesController@show');

    Route::get('places', 'PlacesController@index');
    Route::get('places/{id}', 'PlacesController@show');
    Route::get('galleries', 'GalleriesController@index');
    Route::get('galleries/{id}', 'GalleriesController@show');

    Route::get('exhibitions', 'ExhibitionsController@index');
    Route::get('exhibitions/{id}', 'ExhibitionsController@show');
    Route::get('exhibitions/{id}/artworks', 'ArtworksController@forExhibition');
    Route::get('exhibitions/{id}/venues', 'AgentExhibitionsController@forExhibition');

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

    Route::get('catalogues', 'CataloguesController@index');
    Route::get('catalogues/{id}', 'CataloguesController@show');

    Route::get('terms', 'TermsController@index');
    Route::get('terms/{id}', 'TermsController@show');

    // Shop
    Route::get('shop-categories', 'ShopCategoriesController@index');
    Route::get('shop-categories/{id}', 'ShopCategoriesController@show');

    Route::get('products', 'ProductsController@index');
    Route::get('products/{id}', 'ProductsController@show');

    // Events
    Route::get('legacy-events', 'LegacyEventsController@index');
    Route::get('legacy-events/{id}', 'LegacyEventsController@show');
    Route::get('ticketed-events', 'TicketedEventsController@index');
    Route::get('ticketed-events/{id}', 'TicketedEventsController@show');

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

    // Library
    Route::get('library-materials', 'LibraryMaterialController@index');
    Route::get('library-materials/{id}', 'LibraryMaterialController@show');

    Route::get('library-terms', 'LibraryTermController@index');
    Route::get('library-terms/{id}', 'LibraryTermController@show');

    // Archive
    Route::get('archive-images', 'ArchiveImagesController@index');
    Route::get('archive-images/{id}', 'ArchiveImagesController@show');


});
