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

Route::any('/', function () {
    return redirect('/api/v1');
});


Route::group(['prefix' => 'v1'], function() {

    Route::any('/', function () {
        return redirect('/api/v1/swagger.json');
    });

    Route::any('swagger.json', function() {
        return response(view('swagger'), 200, ['Content-Type' => 'application/json']);
    });

    // Elasticsearch
    Route::match( array('GET', 'POST'), 'search', 'Search\SearchController@search');
    Route::match( array('GET', 'POST'), '{resource}/search', 'Search\SearchController@search');
    // We can do ->where('resource', '(foo|bar)') to limit {resource}, but it's not necessary...

    Route::match( array('GET', 'POST'), 'msearch', 'Search\SearchController@msearch');

    Route::match( array('GET', 'POST'), 'autocomplete', 'Search\SearchController@autocomplete');

    // For debugging search, show generated request
    if( env('APP_ENV') === 'local' ) {
        Route::match( array('GET', 'POST'), 'echo', 'Search\SearchController@echo');
        Route::match( array('GET', 'POST'), '{resource}/echo', 'Search\SearchController@echo');
        Route::match( array('GET', 'POST'), '{resource}/{id}/explain', 'Search\SearchController@explain');
    }


    // Artwork related stuff
    Route::any('artworks', 'ArtworksController@index');

    Route::any('artworks/{id}', 'ArtworksController@show');
    Route::any('artworks/{id}/parts', 'ArtworksController@parts');
    Route::any('artworks/{id}/sets', 'ArtworksController@sets');

    Route::any('artworks/{id}/images', 'ImagesController@forArtwork');
    Route::any('artworks/{id}/categories', 'CategoriesController@forArtwork');

    Route::any('artworks/{id}/artists', 'AgentsController@scopeForArtwork');

    Route::any('artworks/{id}/artwork-catalogues', 'ArtworkCataloguesController@forArtwork'); // pivot

    // Collections
    Route::any('agents', 'AgentsController@index');
    Route::any('agents/{id}', 'AgentsController@show');
    Route::any('agents/{id}/places', 'AgentPlacesController@forAgent'); // pivot
    Route::any('artists', 'AgentsController@indexScope');
    Route::any('artists/{id}', 'AgentsController@showScope');
    Route::any('venues', 'AgentExhibitionsController@index');
    Route::any('venues/{id}', 'AgentExhibitionsController@show');

    Route::any('agent-places', 'AgentPlacesController@index'); // pivot
    Route::any('agent-places/{id}', 'AgentPlacesController@show'); // pivot

    Route::any('agent-types', 'AgentTypesController@index');
    Route::any('agent-types/{id}', 'AgentTypesController@show');

    Route::any('agent-roles', 'AgentRolesController@index');
    Route::any('agent-roles/{id}', 'AgentRolesController@show');

    Route::any('artwork-catalogues', 'ArtworkCataloguesController@index'); // pivot
    Route::any('artwork-catalogues/{id}', 'ArtworkCataloguesController@show'); // pivot

    Route::any('departments', 'CategoriesController@departments');
    Route::any('departments/{id}', 'CategoriesController@show');

    Route::any('artwork-types', 'ArtworkTypesController@index');
    Route::any('artwork-types/{id}', 'ArtworkTypesController@show');

    Route::any('artwork-place-qualifiers', 'ArtworkPlaceQualifiersController@index');
    Route::any('artwork-place-qualifiers/{id}', 'ArtworkPlaceQualifiersController@show');

    Route::any('artwork-date-qualifiers', 'ArtworkDateQualifiersController@index');
    Route::any('artwork-date-qualifiers/{id}', 'ArtworkDateQualifiersController@show');

    Route::any('categories', 'CategoriesController@index');
    Route::any('categories/{id}', 'CategoriesController@show');

    Route::any('category-terms', 'CategoryTermsController@index');
    Route::any('category-terms/{id}', 'CategoryTermsController@show');

    Route::any('places', 'PlacesController@index');
    Route::any('places/{id}', 'PlacesController@show');
    Route::any('galleries', 'GalleriesController@index');
    Route::any('galleries/{id}', 'GalleriesController@show');

    Route::any('exhibitions', 'ExhibitionsController@index');
    Route::any('exhibitions/{id}', 'ExhibitionsController@show');
    Route::any('exhibitions/{id}/artworks', 'ArtworksController@forExhibition');
    Route::any('exhibitions/{id}/venues', 'AgentExhibitionsController@forExhibition');  // pivot

    Route::any('assets', 'AssetsController@index');
    Route::any('assets/{id}', 'AssetsController@show');
    Route::any('images', 'ImagesController@index');
    Route::any('images/{id}', 'ImagesController@show');
    Route::any('videos', 'VideosController@index');
    Route::any('videos/{id}', 'VideosController@show');
    Route::any('sounds', 'SoundsController@index');
    Route::any('sounds/{id}', 'SoundsController@show');
    Route::any('texts', 'TextsController@index');
    Route::any('texts/{id}', 'TextsController@show');

    Route::any('catalogues', 'CataloguesController@index');
    Route::any('catalogues/{id}', 'CataloguesController@show');

    Route::any('terms', 'TermsController@index');
    Route::any('terms/{id}', 'TermsController@show');

    // Shop
    Route::any('shop-categories', 'ShopCategoriesController@index');
    Route::any('shop-categories/{id}', 'ShopCategoriesController@show');

    Route::any('products', 'ProductsController@index');
    Route::any('products/{id}', 'ProductsController@show');

    // Events
    Route::any('legacy-events', 'LegacyEventsController@index');
    Route::any('legacy-events/{id}', 'LegacyEventsController@show');
    Route::any('ticketed-events', 'TicketedEventsController@index');
    Route::any('ticketed-events/{id}', 'TicketedEventsController@show');
    Route::any('ticketed-event-types', 'TicketedEventTypesController@index');
    Route::any('ticketed-event-types/{id}', 'TicketedEventTypesController@show');

    // Mobile App
    Route::any('tours', 'ToursController@index');
    Route::any('tours/{id}', 'ToursController@show');

    Route::any('tour-stops', 'TourStopsController@index');
    Route::any('tour-stops/{id}', 'TourStopsController@show');

    Route::any('mobile-sounds', 'MobileSoundsController@index');
    Route::any('mobile-sounds/{id}', 'MobileSoundsController@show');

    //DSC
    Route::any('publications', 'PublicationsController@index');
    Route::any('publications/{id}', 'PublicationsController@show');

    Route::any('sections', 'SectionsController@index');
    Route::any('sections/{id}', 'SectionsController@show');

    Route::any('sites', 'SitesController@index');
    Route::any('sites/{id}', 'SitesController@show');

    // Library
    Route::any('library-materials', 'LibraryMaterialController@index');
    Route::any('library-materials/{id}', 'LibraryMaterialController@show');

    Route::any('library-terms', 'LibraryTermController@index');
    Route::any('library-terms/{id}', 'LibraryTermController@show');

    // Archive
    Route::any('archive-images', 'ArchiveImagesController@index');
    Route::any('archive-images/{id}', 'ArchiveImagesController@show');

    // Web
    Route::any('tags', 'TagsController@index');
    Route::any('tags/{id}', 'TagsController@show');

    Route::any('locations', 'LocationsController@index');
    Route::any('locations/{id}', 'LocationsController@show');

    Route::any('hours', 'HoursController@index');
    Route::any('hours/{id}', 'HoursController@show');

    Route::any('closures', 'ClosuresController@index');
    Route::any('closures/{id}', 'ClosuresController@show');

    Route::any('web-exhibitions', 'WebExhibitionsController@index');
    Route::any('web-exhibitions/{id}', 'WebExhibitionsController@show');

    Route::any('events', 'EventsController@index');
    Route::any('events/{id}', 'EventsController@show');

    Route::any('articles', 'ArticlesController@index');
    Route::any('articles/{id}', 'ArticlesController@show');

    Route::any('selections', 'SelectionsController@index');
    Route::any('selections/{id}', 'SelectionsController@show');

    Route::any('web-artists', 'WebArtistsController@index');
    Route::any('web-artists/{id}', 'WebArtistsController@show');

    Route::any('generic-pages', 'GenericPagesController@index');
    Route::any('generic-pages/{id}', 'GenericPagesController@show');

    Route::any('press-releases', 'PressReleasesController@index');
    Route::any('press-releases/{id}', 'PressReleasesController@show');

    Route::any('research-guides', 'ResearchGuidesController@index');
    Route::any('research-guides/{id}', 'ResearchGuidesController@show');

    Route::any('educator-resources', 'EducatorResourcesController@index');
    Route::any('educator-resources/{id}', 'EducatorResourcesController@show');

    Route::any('digital-catalogs', 'DigitalCatalogsController@index');
    Route::any('digital-catalogs/{id}', 'DigitalCatalogsController@show');

    Route::any('printed-catalogs', 'PrintedCatalogsController@index');
    Route::any('printed-catalogs/{id}', 'PrintedCatalogsController@show');

    // Generic endpoint to allow source systems to let us know when a record should be updated
    Route::any('{endpoint}/{id}/pull', 'PullController@pull');

});
