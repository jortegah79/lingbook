<?php

use Slim\App;

return function(App $app){

  $app->addErrorMiddleware(true,true,true);

  $app->addBodyParsingMiddleware();

  $app->addRoutingMiddleware();

};