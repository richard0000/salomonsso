<?php

/*
|--------------------------------------------------------------------------
| Churches Routes
|--------------------------------------------------------------------------
|
*/
$router->get('/churches', 'ChurchController@index');
$router->get('/churches/{id}', 'ChurchController@show');
$router->post('/churches', 'ChurchController@store');
$router->put('/churches/{id}', 'ChurchController@update');
$router->delete('/churches/{id}', 'ChurchController@destroy');