<?php

use Laravel\Lumen\Routing\Router;

/** @var Router $router */

$router->group(['prefix' => 'loans'], callback: function () use ($router) {
    $router->get('/', 'LoansController@index');
    $router->get('{id}', 'LoansController@show');
    $router->post('/', 'LoansController@store');
    $router->put('{id}', 'LoansController@update');
    $router->delete('{id}', 'LoansController@delete');
});
