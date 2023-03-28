<?php

namespace App\Controllers;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;


class HomeController{


  function index(Request $request,Response $response, array $data){

    $response->getBody()->write("pagina principal");
    return $response;
  }




}