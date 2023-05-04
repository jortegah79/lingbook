<?php

namespace App\Controllers;

use App\Model\RoomModel;
use App\Model\UserLanguageModel;
use App\Model\UserRoomModel;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class AlumnController
{



  public static function addToClass(Request $request, Response $response, array $args)
  {

    $data['id_room'] = $args['id_room'];

    $data['id_user'] = $args['id'];

    $data['id_language']=UserRoomModel::getByIdRoom($data['id_room'])['id_language'];    

    $result=UserRoomModel::add_to_class($data);

    $response->getBody()->write(json_encode(($result)));

    return $response;
  }
  
public static function showRooms(Request $request, Response $response, array $args){

$result=UserRoomModel::obtieneClasesUsuario($args['id']);

$response->getBody()->write(json_encode($result));

return $response;

}
public static function addLang(Request $request, Response $response, array $args)
{

  $data['id_languages'] = $args['id_lang'];

  $data['id_user'] = $args['id'];
  
  $result=UserLanguageModel::addUserLang($data);
  $response->getBody()->write(json_encode(($result)));

  return $response;
}
public static function showLangs(Request $request, Response $response, array $args)
{
  $result=UserLanguageModel::getLanguagesByIdUser($args['id']);

  $response->getBody()->write(json_encode(($result)));

  return $response;
}
public static function delLang(Request $request, Response $response, array $args)
{
   $data['id_user']=$args['id'];
   
   $data['id_lang']=$args['id_lang'];

   $result=UserLanguageModel::delUsLang($data);

  $response->getBody()->write(json_encode(($result)));

  return $response;
}



}


