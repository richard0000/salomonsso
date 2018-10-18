<?php

/*
|--------------------------------------------------------------------------
| Churches Routes
|--------------------------------------------------------------------------
|
 */
$router->group([
    'middleware' => 'jwt.auth',
    'prefix'     => '/api',
],
    function () use ($router) {
        $router->get('/churches', 'ChurchController@index');
        $router->get('/churches/{id}', 'ChurchController@show');
        $router->post('/churches', 'ChurchController@store');
        $router->put('/churches/{id}', 'ChurchController@update');
        $router->delete('/churches/{id}', 'ChurchController@destroy');
    }
);
