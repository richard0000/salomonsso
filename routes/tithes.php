<?php

/*
|--------------------------------------------------------------------------
| Tithes Routes
|--------------------------------------------------------------------------
|
 */
$router->group([
    'middleware' => 'jwt.auth',
    'prefix'     => '/api'
],
    function () use ($router) {
        $router->get('/tithes', 'TitheController@index');
        $router->get('/user/{id}/tithes', 'UserTithesController@index');
        $router->get('/user/{user_id}/tithes/{tithe_id}', 'UserTithesController@show');
        $router->post('/tithes', 'TitheController@store');
        $router->put('/tithes/{id}', 'TitheController@update');
        $router->delete('/tithes/{id}', 'TitheController@destroy');
    }
);
