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
$router = app()->router;
$router->group(['prefix' => 'api/v1', 'namespace' => 'professionalweb\IntegrationHub\Subsystems\CRMBuffer\Http\Controllers'], function () use ($router) {
    $router->group(['prefix' => 'b2b', 'middleware' => ['b2bAuth']], function () use ($router) {
        $router->post('/leads', 'LeadController@store');
        $router->post('/contacts', 'ContactController@store');
    });
    $router->group(['middleware' => ['auth']], function () use ($router) {
        $router->get('/leads', 'LeadController@index');
        $router->get('/leads/{id}', 'LeadController@view');
        $router->post('/leads', 'LeadController@store');
        $router->delete('/leads/{id}', 'LeadController@destroy');

        $router->get('/contacts', 'ContactController@index');
        $router->get('/contacts/{id}', 'ContactController@view');
        $router->post('/contacts', 'ContactController@store');
        $router->delete('/contacts/{id}', 'ContactController@destroy');

        $router->get('/integrations', 'IntegrationController@index');
        $router->get('/integrations/{id}', 'IntegrationController@view');
        $router->post('/integrations[/{id}]', 'IntegrationController@store');
        $router->delete('/integrations/{id}', 'IntegrationController@destroy');

        $router->get('/drivers', 'DriverController@index');
    });
});