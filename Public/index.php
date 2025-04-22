<?php
    require_once __DIR__.'/../vendor/autoload.php';
    require_once __DIR__.'/../Core/Router.php';

    $uri = $_SERVER['REQUEST_URI']; // Obtener la URI de la solicitud actual (/productos.php?id=5)
    $router = new Router();
    $router->redireccion($uri);
?>