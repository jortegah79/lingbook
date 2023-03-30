<?php

namespace App\Controllers;

use App\Model\UserModel;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class UserController
{

  function show(Request $request, Response $response, array $data)
  {
    $data = UserModel::select();
    $response->getBody()->write(json_encode($data));
    return $response;
  }
  
  function create(Request $request, Response $response, array $data)
  {
    $data = $request->getParsedBody();
    $id = UserModel::create_user($data);
    $response->getBody()->write(strval($id));
    return $response->withHeader('Access-Control-Allow-Origin', '*');
  }
}
