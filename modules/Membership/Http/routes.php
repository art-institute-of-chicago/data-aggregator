<?php

Route::group([
    'middleware' => 'api',
    'prefix' => 'api/v1',
    'namespace' => 'Modules\Membership\Http\Controllers'
], function()
{

    // Membership/Events
    Route::get('events', 'EventsController@index');
    Route::get('events/{id}', 'EventsController@show');

    Route::get('members/{id}', 'MembersController@show');

});
