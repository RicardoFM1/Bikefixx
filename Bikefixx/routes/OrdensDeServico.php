<?php

/** @var Laravel/Lumen/Routing/Router $router */


$router->group(['prefix' => '/ordens'], function () use ($router) {
    $router->get('', ['middleware' => ['auth', 'role:admin,mecanico'], 'uses' => 'OrdensController@listarOrdens']);
    $router->get('/proprias', ['middleware' => ['auth', 'role:cliente,mecanico'], 'uses' => 'OrdensController@listarOrdensProprias']);
    $router->get('/{ordemId}', ['middleware' => ['auth', 'role:admin'], 'uses' => 'OrdensController@listarOrdemPorId']);
    $router->post('/', ['middleware' => ['auth', 'role:mecanico,admin'], 'uses' => 'OrdensController@criarOrdem']);
    $router->patch('/{ordemId}', ['middleware' => ['auth', 'role:mecanico,admin'], 'uses' =>  'OrdensController@atualizarOrdem']);
    $router->delete('/{ordemId}', ['middleware' => ['auth', 'role:admin'], 'uses' => 'OrdensController@deletarOrdem']);
});
