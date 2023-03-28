<?php

use Slim\App;
use App\Controllers\HomeController;
use App\Controllers\LoginController;
use App\Controllers\UserController;
use Slim\Routing\RouteCollectorProxy;

return function(App $app){
  
  $app->get('/',HomeController::class . ':index');


  $app->get('/users/all',UserController::class.':show');
  $app->post('/users/new',UserController::class.':create');


  $app->get('/login',LoginController::class. ':secure');
  $app->post('/login',LoginController::class. ':login');
  
};

