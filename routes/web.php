<?php

/** @var \Laravel\Lumen\Routing\Router $router */

use illuminate\Support\Str;

$router->get('/', function () {
    return Str::random(32);
});

$router->post('/register', 'AuthController@register');
$router->post('/login', 'AuthController@login');
$router->get('/users', 'UserController@index');
