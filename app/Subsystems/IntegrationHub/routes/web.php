<?php

Route::group(['prefix' => 'api/v1', 'middleware' => ['api'], 'namespace' => 'App\Subsystems\IntegrationHub\Http\Controllers'], function () {
    Route::get('navigation', 'NavigationController@index');
    Route::post('login', 'AuthController@login');
    Route::group(['middleware' => ['auth']], function () {
        Route::get('/applications', 'ApplicationController@index');
        Route::get('/applications/{id}', 'ApplicationController@view');
        Route::post('/applications[/{id}]', 'ApplicationController@store');
        Route::delete('/applications/{id}', 'ApplicationController@destroy');
        Route::post('/applications/{id}/regenerate-keys', 'ApplicationController@regenerateTokens');
    });

    Route::group(['middleware' => ['b2bAuth']], function () {
        Route::post('events', 'EventController@store');
    });
});