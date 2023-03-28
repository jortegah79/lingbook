<?php
require (__DIR__.'/vendor/autoload.php');

use Slim\Factory\AppFactory;

$app=AppFactory::create();

//midlewares

$middlewares=require __DIR__."/app/middlewares.php";
$middlewares($app);

$app->setBasePath('/lingbook');

//Generando las rutas

$routes=require __DIR__."/app/routes.php";
$routes($app);

$app->run();