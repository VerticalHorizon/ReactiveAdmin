<?php

/**
 * Routes
 */
Route::group(array('prefix' => Config::get('readmin::readmin.uri'), 'before' => 'auth'), function()
{
    Route::post('/{alias}/upload', 'AdminController@upload');
    Route::put('/{alias}/{id?}/upload', 'AdminController@upload');
    Route::delete('/upload', 'AdminController@upload');

    Route::get('/{alias?}',                'AdminController@index');   //  model ? model : dashboard
    Route::get('/{alias}/create',          'AdminController@create');
    Route::get('/{alias}/{id}',            'AdminController@show');
    Route::get('/{alias}/{id}/edit',       'AdminController@edit');
    Route::group(array('before' => 'csrf'), function()
    {
        Route::post('/{alias}',                'AdminController@store');
        Route::put('/{alias}/{id}',            'AdminController@update');
        Route::delete('/{alias}/{id}/destroy', 'AdminController@destroy');
    });
    Route::resource('/', 'AdminController');
});