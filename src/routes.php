<?php

/**
 * Routes
 */
Route::group(array('prefix' => Config::get('reactiveadmin::uri'), 'before' => 'auth'), function()
{
    Route::post('/{alias}/upload', 'Verticalhorizon\Reactiveadmin\AdminController@upload');
    Route::put('/{alias}/{id?}/upload', 'Verticalhorizon\Reactiveadmin\AdminController@upload');
    Route::delete('/upload', 'Verticalhorizon\Reactiveadmin\AdminController@upload');

    Route::get('/{alias?}',                'Verticalhorizon\Reactiveadmin\AdminController@index');   //  model ? model : dashboard
    Route::get('/{alias}/create',          'Verticalhorizon\Reactiveadmin\AdminController@create');
    Route::get('/{alias}/{id}',            'Verticalhorizon\Reactiveadmin\AdminController@show');
    Route::get('/{alias}/{id}/edit',       'Verticalhorizon\Reactiveadmin\AdminController@edit');
    Route::group(array('before' => 'csrf'), function()
    {
        Route::post('/{alias}',                'Verticalhorizon\Reactiveadmin\AdminController@store');
        Route::put('/{alias}/{id}',            'Verticalhorizon\Reactiveadmin\AdminController@update');
        Route::delete('/{alias}/{id}/destroy', 'Verticalhorizon\Reactiveadmin\AdminController@destroy');
    });
    Route::resource('/', 'Verticalhorizon\Reactiveadmin\AdminController');
});