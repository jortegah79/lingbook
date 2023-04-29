<?php

namespace App\Controllers;

use App\Model\UserRoomModel;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class AlumnController
{



  public static function addToClass(Request $request, Response $response, array $args)
  {

    $data = (array)$request->getParsedBody();

    $data['id_user'] = $args['id'];

    $result=UserRoomModel::add_to_class($data);

    $response->getBody()->write(json_encode(($result)));

    return $response;
  }
  
public static function showRooms(Request $request, Response $response, array $args){

$result=UserRoomModel::obtieneClasesUsuario($args['id']);

$response->getBody()->write(json_encode($result));

return $response;

}




}


