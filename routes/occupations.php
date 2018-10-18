<?php

/*
|--------------------------------------------------------------------------
| Occupation Routes
|--------------------------------------------------------------------------
|
 */
$router->group([
    'middleware' => 'jwt.auth',
    'prefix'     => '/api'
],
    function () use ($router) {
        $router->get('/occupations', 'OccupationController@index');
        $router->get('/occupations/{id}', 'OccupationController@show');
        $router->post('/occupations', 'OccupationController@store');
        $router->put('/occupations/{id}', 'OccupationController@update');
        $router->delete('/occupations/{id}', 'OccupationController@destroy');
    }
);
