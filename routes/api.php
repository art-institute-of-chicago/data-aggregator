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
    Route::any('artworks', 'ResourceController@index');
    Route::any('artworks/{id}', 'ResourceController@show');

    // Collections
    Route::any('agents', 'ResourceController@index');
    Route::any('agents/{id}', 'ResourceController@show');

    Route::any('artists', 'ResourceController@indexScope');
    Route::any('artists/{id}', 'ResourceController@showScope');

    Route::any('agent-types', 'ResourceController@index');
    Route::any('agent-types/{id}', 'ResourceController@show');

    Route::any('agent-roles', 'ResourceController@index');
    Route::any('agent-roles/{id}', 'ResourceController@show');

    Route::any('artwork-catalogues', 'ResourceController@index'); // pivot
    Route::any('artwork-catalogues/{id}', 'ResourceController@show'); // pivot

    Route::any('artwork-types', 'ResourceController@index');
    Route::any('artwork-types/{id}', 'ResourceController@show');

    Route::any('artwork-place-qualifiers', 'ResourceController@index');
    Route::any('artwork-place-qualifiers/{id}', 'ResourceController@show');

    Route::any('artwork-date-qualifiers', 'ResourceController@index');
    Route::any('artwork-date-qualifiers/{id}', 'ResourceController@show');

    Route::any('categories', 'ResourceController@index');
    Route::any('categories/{id}', 'ResourceController@show');

    Route::any('departments', 'ResourceController@indexScope');
    Route::any('departments/{id}', 'ResourceController@showScope');

    Route::any('category-terms', 'ResourceController@index');
    Route::any('category-terms/{id}', 'ResourceController@show');

    Route::any('places', 'ResourceController@index');
    Route::any('places/{id}', 'ResourceController@show');

    Route::any('galleries', 'ResourceController@index');
    Route::any('galleries/{id}', 'ResourceController@show');

    Route::any('exhibitions', 'ResourceController@index');
    Route::any('exhibitions/{id}', 'ResourceController@show');

    Route::any('assets', 'ResourceController@index');
    Route::any('assets/{id}', 'ResourceController@show');
    Route::any('images', 'ResourceController@index');
    Route::any('images/{id}', 'ResourceController@show');
    Route::any('videos', 'ResourceController@index');
    Route::any('videos/{id}', 'ResourceController@show');
    Route::any('sounds', 'ResourceController@index');
    Route::any('sounds/{id}', 'ResourceController@show');
    Route::any('texts', 'ResourceController@index');
    Route::any('texts/{id}', 'ResourceController@show');

    Route::any('catalogues', 'ResourceController@index');
    Route::any('catalogues/{id}', 'ResourceController@show');

    Route::any('terms', 'ResourceController@index');
    Route::any('terms/{id}', 'ResourceController@show');

    // Shop
    Route::any('shop-categories', 'ResourceController@index');
    Route::any('shop-categories/{id}', 'ResourceController@show');

    Route::any('products', 'ResourceController@index');
    Route::any('products/{id}', 'ResourceController@show');

    // Events
    Route::any('legacy-events', 'ResourceController@index');
    Route::any('legacy-events/{id}', 'ResourceController@show');
    Route::any('ticketed-events', 'ResourceController@index');
    Route::any('ticketed-events/{id}', 'ResourceController@show');
    Route::any('ticketed-event-types', 'ResourceController@index');
    Route::any('ticketed-event-types/{id}', 'ResourceController@show');

    // Mobile App
    Route::any('tours', 'ResourceController@index');
    Route::any('tours/{id}', 'ResourceController@show');

    Route::any('tour-stops', 'ResourceController@index');
    Route::any('tour-stops/{id}', 'ResourceController@show');

    Route::any('mobile-sounds', 'ResourceController@index');
    Route::any('mobile-sounds/{id}', 'ResourceController@show');

    //DSC
    Route::any('publications', 'ResourceController@index');
    Route::any('publications/{id}', 'ResourceController@show');

    Route::any('sections', 'ResourceController@index');
    Route::any('sections/{id}', 'ResourceController@show');

    Route::any('sites', 'ResourceController@index');
    Route::any('sites/{id}', 'ResourceController@show');

    // Library
    Route::any('library-materials', 'ResourceController@index');
    Route::any('library-materials/{id}', 'ResourceController@show');

    Route::any('library-terms', 'ResourceController@index');
    Route::any('library-terms/{id}', 'ResourceController@show');

    // Archive
    Route::any('archive-images', 'ResourceController@index');
    Route::any('archive-images/{id}', 'ResourceController@show');

    // Web
    Route::any('tags', 'ResourceController@index');
    Route::any('tags/{id}', 'ResourceController@show');

    Route::any('locations', 'ResourceController@index');
    Route::any('locations/{id}', 'ResourceController@show');

    Route::any('hours', 'ResourceController@index');
    Route::any('hours/{id}', 'ResourceController@show');

    Route::any('closures', 'ResourceController@index');
    Route::any('closures/{id}', 'ResourceController@show');

    Route::any('web-exhibitions', 'ResourceController@index');
    Route::any('web-exhibitions/{id}', 'ResourceController@show');

    Route::any('events', 'ResourceController@index');
    Route::any('events/{id}', 'ResourceController@show');

    Route::any('event-programs', 'ResourceController@index');
    Route::any('event-programs/{id}', 'ResourceController@show');

    Route::any('event-occurrences', 'ResourceController@index');
    Route::any('event-occurrences/{id}', 'ResourceController@show');

    Route::any('articles', 'ResourceController@index');
    Route::any('articles/{id}', 'ResourceController@show');

    Route::any('selections', 'ResourceController@index');
    Route::any('selections/{id}', 'ResourceController@show');

    Route::any('web-artists', 'ResourceController@index');
    Route::any('web-artists/{id}', 'ResourceController@show');

    Route::any('generic-pages', 'ResourceController@index');
    Route::any('generic-pages/{id}', 'ResourceController@show');

    Route::any('press-releases', 'ResourceController@index');
    Route::any('press-releases/{id}', 'ResourceController@show');

    Route::any('research-guides', 'ResourceController@index');
    Route::any('research-guides/{id}', 'ResourceController@show');

    Route::any('educator-resources', 'ResourceController@index');
    Route::any('educator-resources/{id}', 'ResourceController@show');

    Route::any('digital-catalogs', 'ResourceController@index');
    Route::any('digital-catalogs/{id}', 'ResourceController@show');

    Route::any('printed-catalogs', 'ResourceController@index');
    Route::any('printed-catalogs/{id}', 'ResourceController@show');

    // Digital Labels
    Route::any('digital-labels', 'ResourceController@index');
    Route::any('digital-labels/{id}', 'ResourceController@show');

});
