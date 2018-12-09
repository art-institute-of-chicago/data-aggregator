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

    Route::match( array('GET', 'POST'), 'autocomplete', 'Search\SearchController@autocompleteWithTitle');
    Route::match( array('GET', 'POST'), 'autosuggest', 'Search\SearchController@autocompleteWithSource');

    // For debugging search, show generated request
    if( env('APP_ENV') === 'local' ) {
        Route::match( array('GET', 'POST'), 'echo', 'Search\SearchController@echo');
        Route::match( array('GET', 'POST'), '{resource}/echo', 'Search\SearchController@echo');
        Route::match( array('GET', 'POST'), '{resource}/{id}/explain', 'Search\SearchController@explain');
    }


    // Artwork related stuff
    Route::any('artworks', 'Refactor\ConfigController@index');
    Route::any('artworks/{id}', 'Refactor\ConfigController@show');

    // Collections
    Route::any('agents', 'Refactor\ConfigController@index');
    Route::any('agents/{id}', 'Refactor\ConfigController@show');

    Route::any('artists', 'Refactor\ConfigController@indexScope');
    Route::any('artists/{id}', 'Refactor\ConfigController@showScope');

    Route::any('agent-types', 'Refactor\ConfigController@index');
    Route::any('agent-types/{id}', 'Refactor\ConfigController@show');

    Route::any('agent-roles', 'Refactor\ConfigController@index');
    Route::any('agent-roles/{id}', 'Refactor\ConfigController@show');

    Route::any('artwork-catalogues', 'Refactor\ConfigController@index'); // pivot
    Route::any('artwork-catalogues/{id}', 'Refactor\ConfigController@show'); // pivot

    Route::any('artwork-types', 'Refactor\ConfigController@index');
    Route::any('artwork-types/{id}', 'Refactor\ConfigController@show');

    Route::any('artwork-place-qualifiers', 'Refactor\ConfigController@index');
    Route::any('artwork-place-qualifiers/{id}', 'Refactor\ConfigController@show');

    Route::any('artwork-date-qualifiers', 'Refactor\ConfigController@index');
    Route::any('artwork-date-qualifiers/{id}', 'Refactor\ConfigController@show');

    Route::any('categories', 'Refactor\ConfigController@index');
    Route::any('categories/{id}', 'Refactor\ConfigController@show');

    Route::any('departments', 'Refactor\ConfigController@indexScope');
    Route::any('departments/{id}', 'Refactor\ConfigController@showScope');

    Route::any('category-terms', 'Refactor\ConfigController@index');
    Route::any('category-terms/{id}', 'Refactor\ConfigController@show');

    Route::any('places', 'Refactor\ConfigController@index');
    Route::any('places/{id}', 'Refactor\ConfigController@show');

    Route::any('galleries', 'Refactor\ConfigController@index');
    Route::any('galleries/{id}', 'Refactor\ConfigController@show');

    Route::any('exhibitions', 'Refactor\ConfigController@index');
    Route::any('exhibitions/{id}', 'Refactor\ConfigController@show');

    Route::any('assets', 'Refactor\ConfigController@index');
    Route::any('assets/{id}', 'Refactor\ConfigController@show');
    Route::any('images', 'Refactor\ConfigController@index');
    Route::any('images/{id}', 'Refactor\ConfigController@show');
    Route::any('videos', 'Refactor\ConfigController@index');
    Route::any('videos/{id}', 'Refactor\ConfigController@show');
    Route::any('sounds', 'Refactor\ConfigController@index');
    Route::any('sounds/{id}', 'Refactor\ConfigController@show');
    Route::any('texts', 'Refactor\ConfigController@index');
    Route::any('texts/{id}', 'Refactor\ConfigController@show');

    Route::any('catalogues', 'Refactor\ConfigController@index');
    Route::any('catalogues/{id}', 'Refactor\ConfigController@show');

    Route::any('terms', 'Refactor\ConfigController@index');
    Route::any('terms/{id}', 'Refactor\ConfigController@show');

    // Shop
    Route::any('shop-categories', 'Refactor\ConfigController@index');
    Route::any('shop-categories/{id}', 'Refactor\ConfigController@show');

    Route::any('products', 'Refactor\ConfigController@index');
    Route::any('products/{id}', 'Refactor\ConfigController@show');

    // Events
    Route::any('legacy-events', 'Refactor\ConfigController@index');
    Route::any('legacy-events/{id}', 'Refactor\ConfigController@show');
    Route::any('ticketed-events', 'Refactor\ConfigController@index');
    Route::any('ticketed-events/{id}', 'Refactor\ConfigController@show');
    Route::any('ticketed-event-types', 'Refactor\ConfigController@index');
    Route::any('ticketed-event-types/{id}', 'Refactor\ConfigController@show');

    // Mobile App
    Route::any('tours', 'Refactor\ConfigController@index');
    Route::any('tours/{id}', 'Refactor\ConfigController@show');

    Route::any('tour-stops', 'Refactor\ConfigController@index');
    Route::any('tour-stops/{id}', 'Refactor\ConfigController@show');

    Route::any('mobile-sounds', 'Refactor\ConfigController@index');
    Route::any('mobile-sounds/{id}', 'Refactor\ConfigController@show');

    //DSC
    Route::any('publications', 'Refactor\ConfigController@index');
    Route::any('publications/{id}', 'Refactor\ConfigController@show');

    Route::any('sections', 'Refactor\ConfigController@index');
    Route::any('sections/{id}', 'Refactor\ConfigController@show');

    Route::any('sites', 'Refactor\ConfigController@index');
    Route::any('sites/{id}', 'Refactor\ConfigController@show');

    // Library
    Route::any('library-materials', 'Refactor\ConfigController@index');
    Route::any('library-materials/{id}', 'Refactor\ConfigController@show');

    Route::any('library-terms', 'Refactor\ConfigController@index');
    Route::any('library-terms/{id}', 'Refactor\ConfigController@show');

    // Archive
    Route::any('archive-images', 'Refactor\ConfigController@index');
    Route::any('archive-images/{id}', 'Refactor\ConfigController@show');

    // Web
    Route::any('tags', 'Refactor\ConfigController@index');
    Route::any('tags/{id}', 'Refactor\ConfigController@show');

    Route::any('locations', 'Refactor\ConfigController@index');
    Route::any('locations/{id}', 'Refactor\ConfigController@show');

    Route::any('hours', 'Refactor\ConfigController@index');
    Route::any('hours/{id}', 'Refactor\ConfigController@show');

    Route::any('closures', 'Refactor\ConfigController@index');
    Route::any('closures/{id}', 'Refactor\ConfigController@show');

    Route::any('web-exhibitions', 'Refactor\ConfigController@index');
    Route::any('web-exhibitions/{id}', 'Refactor\ConfigController@show');

    Route::any('events', 'Refactor\ConfigController@index');
    Route::any('events/{id}', 'Refactor\ConfigController@show');

    Route::any('event-programs', 'Refactor\ConfigController@index');
    Route::any('event-programs/{id}', 'Refactor\ConfigController@show');

    Route::any('event-occurrences', 'Refactor\ConfigController@index');
    Route::any('event-occurrences/{id}', 'Refactor\ConfigController@show');

    Route::any('articles', 'Refactor\ConfigController@index');
    Route::any('articles/{id}', 'Refactor\ConfigController@show');

    Route::any('selections', 'Refactor\ConfigController@index');
    Route::any('selections/{id}', 'Refactor\ConfigController@show');

    Route::any('web-artists', 'Refactor\ConfigController@index');
    Route::any('web-artists/{id}', 'Refactor\ConfigController@show');

    Route::any('generic-pages', 'Refactor\ConfigController@index');
    Route::any('generic-pages/{id}', 'Refactor\ConfigController@show');

    Route::any('press-releases', 'Refactor\ConfigController@index');
    Route::any('press-releases/{id}', 'Refactor\ConfigController@show');

    Route::any('research-guides', 'Refactor\ConfigController@index');
    Route::any('research-guides/{id}', 'Refactor\ConfigController@show');

    Route::any('educator-resources', 'Refactor\ConfigController@index');
    Route::any('educator-resources/{id}', 'Refactor\ConfigController@show');

    Route::any('digital-catalogs', 'Refactor\ConfigController@index');
    Route::any('digital-catalogs/{id}', 'Refactor\ConfigController@show');

    Route::any('printed-catalogs', 'Refactor\ConfigController@index');
    Route::any('printed-catalogs/{id}', 'Refactor\ConfigController@show');

    // Digital Labels
    Route::any('digital-labels', 'Refactor\ConfigController@index');
    Route::any('digital-labels/{id}', 'Refactor\ConfigController@show');

});
