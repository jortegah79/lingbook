<?php

namespace App\Controllers;

use App\Model\Bbdd;
use App\Model\User;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;


class UserController
{

  function show(Request $request, Response $response, array $data)
  {

    $bd = Bbdd::get_conection();
    $res = $bd->query("Select * from USERS");
    $data = [];
    while ($row = $res->fetch_assoc()) {
      $data[] = $row;
    }

    $response->getBody()->write(json_encode($data));
    return $response;


    // $data = User::get_all();
    //$response->getBody()->write(json_encode($data));
  }
  function create(Request $request, Response $response, array $data)
  {
    $data = $request->getParsedBody();
    // $pass=hash(User::SALT,$data['password']);
    // $tipo=User::devuelve_tipo($data['type']);
    $bd = Bbdd::get_conection();
    $sql = "insert into USERS (name,surname,mail,password,type,updated_at,created_at) values('" . $data['name'] . "','" . $data['surname'] . "','" . $data['mail'] . "','" . $data['password'] . "','" . $data['type'] . "','" . date('Y-m-d H:i:s') . "','" . date('Y-m-d H:i:s') . "')";
    $bd->query($sql);

    $response->getBody()->write(strval($bd->insert_id));
    return $response;
  }
}
