<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/
/** @var \Laravel\Lumen\Routing\Router $router */
$router->group(['prefix' => 'api/v1', 'middleware' => ['auth']], function () use ($router) {
    $router->get('/applications', 'ApplicationController@index');
    $router->get('/applications/{id}', 'ApplicationController@view');
    $router->post('/applications[/{id}]', 'ApplicationController@store');
    $router->delete('/applications/{id}', 'ApplicationController@destroy');
    $router->post('/applications/{id}/regenerate-keys', 'ApplicationController@regenerateTokens');
});

$router->post('/api/v1/login', 'AuthController@login');