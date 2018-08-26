<?php

/*
|--------------------------------------------------------------------------
| User Routes
|--------------------------------------------------------------------------
|
 */
$router->group([
    'middleware' => 'jwt.auth',
    'prefix'     => '/api',
],
    function () use ($router) {
        $router->get('/users/', 'UserController@index');
        $router->post('/users/', 'UserController@store');
        $router->get('/users/{id}', 'UserController@show');
        $router->put('/users/{id}', 'UserController@update');
        $router->delete('/users/{id}', 'UserController@destroy');
    }
);
