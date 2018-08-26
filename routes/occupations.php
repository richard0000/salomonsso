<?php

/*
|--------------------------------------------------------------------------
| Occupation Routes
|--------------------------------------------------------------------------
|
*/
$router->get('/occupations', 'OccupationController@index');
$router->get('/occupations/{id}', 'OccupationController@show');
$router->post('/occupations', 'OccupationController@store');
$router->put('/occupations/{id}', 'OccupationController@update');
$router->delete('/occupations/{id}', 'OccupationController@destroy');