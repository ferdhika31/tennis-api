<?php

use Laravel\Lumen\Routing\Router;

/** @var Router $router */

$router->post("/register", "UserController@register");

$router->group(['middleware'=>'auth:api'], function () use ($router) {
    $router->get("/me", "UserController@me");

    $router->group(['prefix' => 'containers'], function () use ($router) {
        $router->get("/", "ContainerController@index");
        $router->post("/", "ContainerController@store");
        $router->patch("/{id}", "ContainerController@update");
    });

    $router->post('/player/put-ball', 'UserController@putBall');
});
