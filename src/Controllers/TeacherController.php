<?php

namespace App\Controllers;

use App\Model\MessagesModel;
use App\Model\RoomModel;
use App\Model\UserLanguageModel;
use App\Model\UserModel;
use App\Model\UserRoomModel;
use App\Model\UserVideoMessagesModel;
use App\Model\VideosModel;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class TeacherController
{

  function newlang(Request $request, Response $response, array $args)
  {
    $user=UserModel::one_by_id($args['id']);
   
    if($user['type']=="teacher"){
    
      $data['id_users']=$args['id'];

      $data['id_languages']=$args['id_lang'];
  
      $resultado=UserLanguageModel::addUserLang($data);

      $response->getBody()->write(json_encode($resultado));

    }else{
       $response->getBody()->write("false");
    }

    return $response;
  }

  function showLang(Request $request, Response $response, array $args)
  {

    $user=UserModel::one_by_id($args['id']);

    if($user['type']=="teacher"){

      $data=UserLanguageModel::getLanguagesByIdUser($args['id'])[0];
      
      $response->getBody()->write(json_encode($data));

    }else{

      $response->getBody()->write("false");
   }

   return $response;
  }

  function newRoom(Request $request, Response $response, array $args)
  {

    $id_teacher = $args['id'];

    $user = UserModel::one_by_id($id_teacher);

    if (count($user) > 0 && $user['type'] == "teacher") {

      $data = (array)$request->getParsedBody();

      $data['id_language']=UserLanguageModel::getLanguagesByIdUser($id_teacher)[0]['id_language'];

      $data['id_user']=$args['id'];

      $data['id_room'] = RoomModel::createRoom($data);

      $result = UserRoomModel::add_to_class($data);

      $response->getBody()->write(json_encode($result));

      return $response;
    } else {

      return false;
    }
  }
  function deleteRoom(Request $request, Response $response, array $args)
  {
    $id_teacher = $args['id'];

    $user = UserModel::one_by_id($id_teacher);

    if (count($user) > 0 && $user['type'] == "teacher") {

      $result=RoomModel::deleteRoom($args['id_room']);
     
      $response->getBody()->write(json_encode($result));

      return $response;
    } else {

      return "false";
    }
  }
  function showVideos(Request $request, Response $response, array $args)
  {
    
    $result = VideosModel::getVideosById($args['id']);

    $response->getBody()->write(json_encode($result));

    return $response;
  }

  function showRooms(Request $request, Response $response, array $args)
  {

    $user = UserModel::one_by_id($args['id']);

    if (count($user) > 0 && $user['type'] == "teacher") {

      $result = UserRoomModel::obtieneClasesUsuario($args['id']);
    } else {
      $result = [];
    }
    $response->getBody()->write(json_encode($result));

    return $response;
  }
}
