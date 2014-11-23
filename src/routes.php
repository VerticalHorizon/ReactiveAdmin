<?php

/**
 * Routes
 */
Route::group(array('prefix' => Config::get('reactiveadmin::uri'), 'before' => 'auth'), function()
{
    Route::get('/lang/{id}', function($id)
    {
        //dd(Config::get('reactiveadmin::locales')[$id]);
        \App::setLocale(Config::get('reactiveadmin::locales')[$id]);
        Lang::setLocale('en');
        return \Redirect::back();
    });

    Route::post('/{alias}/upload',          '\VerticalHorizon\ReactiveAdmin\AdminController@upload');
    Route::put('/{alias}/{id?}/upload',     '\VerticalHorizon\ReactiveAdmin\AdminController@upload');
    Route::delete('/upload',                '\VerticalHorizon\ReactiveAdmin\AdminController@upload');

    Route::get('/{alias?}',                 '\VerticalHorizon\ReactiveAdmin\AdminController@index');   //  model ? model : dashboard
    Route::get('/{alias}/create',           '\VerticalHorizon\ReactiveAdmin\AdminController@create');
    Route::get('/{alias}/{id}',             '\VerticalHorizon\ReactiveAdmin\AdminController@show');
    Route::get('/{alias}/{id}/edit',        '\VerticalHorizon\ReactiveAdmin\AdminController@edit');

    Route::get('/{alias}/{id}/trash',       '\VerticalHorizon\ReactiveAdmin\AdminController@trash');
    Route::get('/{alias}/{id}/restore',     '\VerticalHorizon\ReactiveAdmin\AdminController@restore');

    Route::group(array('before' => 'csrf'), function()
    {
        Route::post('/{alias}',                '\VerticalHorizon\ReactiveAdmin\AdminController@store');
        Route::put('/{alias}/{id}',            '\VerticalHorizon\ReactiveAdmin\AdminController@update');
        Route::delete('/{alias}/{id}/destroy', '\VerticalHorizon\ReactiveAdmin\AdminController@destroy');
    });
    Route::resource('/',    '\VerticalHorizon\ReactiveAdmin\AdminController');
});