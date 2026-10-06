<?php

/** @var Laravel/Lumen/Routing/Router $router */

$router->group(['prefix' => '/dashboard'], function () use ($router) {
    $router->get('', 'DashboardController@retornar');
});