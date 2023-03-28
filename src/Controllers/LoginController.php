<?php

namespace App\Controllers;

require_once "./src/Model/config.php";
use App\Model\Bbdd;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;


class LoginController
{


  function secure(Request $request, Response $response, array $data)
  {
    session_start();
    if (isset($_SESSION['TOKEN'])) {
      if ((strtotime($_SESSION['date_token']) +UN_DIA) < strtotime(date('Y-m-d H:i:s'))) {
        $_SESSION['TOKEN'] = uniqid();
        $_SESSION['date_token'] = date('Y-m-d H:i:s');
      }
    } else {
      $_SESSION['TOKEN'] = uniqid();
      $_SESSION['date_token'] = date('Y-m-d H:i:s');
    }

    $data['TOKEN_API'] = $_SESSION['TOKEN'];

    $response->getBody()->write(json_encode($data));

    return $response->withHeader("OK", 200);
  }

  
  function login(Request $request, Response $response, array $data)
  {

    $response->getBody()->write("pagina login segunda parte");

    return $response;
  }
}
