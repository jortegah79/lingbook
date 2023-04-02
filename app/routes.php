<?php

use Slim\App;
use App\Controllers\HomeController;
use App\Controllers\LoginController;
use App\Controllers\UserController;

use Slim\Routing\RouteCollectorProxy;

return function (App $app) {

  $app->get('/', HomeController::class . ':index');

  $app->group('/users', function (RouteCollectorProxy $group) {
    $group->get('/all', UserController::class . ':show');
    $group->post('/new', UserController::class . ':create');
    $group->get('/login', LoginController::class . ':secure');
    $group->post('/login', LoginController::class . ':login');
  });
};
