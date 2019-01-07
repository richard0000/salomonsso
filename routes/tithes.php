<?php

/*
|--------------------------------------------------------------------------
| Tithes Routes
|--------------------------------------------------------------------------
|
 */
$router->group([
    //'middleware' => 'jwt.auth',
    'prefix'     => '/api'
],
    function () use ($router) {
        $router->get('/export/tithes', 'ExportTitheController@index');
        $router->get('/tithes', 'TitheController@index');
        $router->get('/tithes/dates', 'TitheDatesController@index');
        $router->get('/tithes/{tithe_id}', 'TitheController@show');
        $router->get('/users/{id}/tithes', 'UserTithesController@index');
        $router->get('/users/{id}/tithes/dates', 'UserTitheDatesController@index');
        $router->get('/users/{user_id}/tithes/{tithe_id}', 'UserTithesController@show');
        $router->post('/tithes', 'TitheController@store');
        $router->put('/tithes/{id}', 'TitheController@update');
        $router->delete('/tithes/{id}', 'TitheController@destroy');
    }
);
