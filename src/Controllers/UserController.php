<?php

namespace App\Controllers;

use App\Model\UserModel;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class UserController
{

  /**
   * Funcion que muestra todos los usuarios de la aplicacion.
   */
  function show(Request $request, Response $response, array $data)
  {
    $data = UserModel::select();

    foreach ($data as $k => $v) {

      $data[$k]['type'] = UserModel::devuelve_tipo($data[$k]['type']);

      unset($data[$k]['password']);
    }

    $response->getBody()->write(json_encode($data));

    return $response;
  }
  /**
   * Creamos un usuario con los datos pasados.
   */
  function create(Request $request, Response $response, array $data)
  {
    $data = (array) $request->getParsedBody();

    $id = UserModel::create_user($data);

    $response->getBody()->write(strval($id));

    return $response->withHeader('Access-Control-Allow-Origin', '*');
  }

  /**
   * devuelve un lenguaje especificado
   */
  function getone(Request $request, Response $response, array $data)
  {
    $data = UserModel::one_by_id($data['id']);

    if (count($data) > 0) {

      $data['type'] = UserModel::devuelve_tipo($data['type']);
    }

    $response->getBody()->write(json_encode($data));

    return $response;
  }
  
  function edit(Request $request, Response $response, array $data)
  {

    $idUser = $data['id'];

    $data = (array)$request->getParsedBody();

    $value = UserModel::editUser($idUser, $data);

    $response->getBody()->write(json_encode($value));

    return $response;
  }
  function changeStatus(Request $request, Response $response, array $data)
  {

    $result = UserModel::changeStatus($data['id']);

    $response->getBody()->write(json_encode($result));

    return $response;
  }

  function teachers(Request $request, Response $response, array $data)
  {
    $data = UserModel::getAllTeachers();
    foreach ($data as $k => $v) {

      $data[$k]['type'] = UserModel::devuelve_tipo($data[$k]['type']);

      unset($data[$k]['password']);
    }
    $response->getBody()->write(\json_encode($data));

    return $response;
  }
}
