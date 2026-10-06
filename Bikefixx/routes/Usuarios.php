<?php

/** @var Laravel/Lumen/Routing/Router $router */


$router->group(['prefix' => '/usuarios'], function () use ($router) {
    $router->get('', ['middleware' => ['auth'], 'uses' => 'UsuarioController@listarUsuarios']);
    $router->post('/login', ['middleware' => 'guest', 'uses' => 'UsuarioController@fazerLogin']);
});
