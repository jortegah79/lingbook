<?php

namespace App\Controllers;

use App\Model\MessagesModel;
use App\Model\RoomModel;
use App\Model\UserModel;
use App\Model\UserRoomModel;
use App\Model\UserVideoMessagesModel;
use App\Model\VideosModel;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class TeacherController{


   function newRoom(Request $request, Response $response, array $args){

      $id_teacher=$args['id'];

    $data=(array)$request->getParsedBody();
   
     $data['id_room']=RoomModel::createRoom($data);

     $result=UserRoomModel::add_to_class($data);
     
     $response->getBody()->write(json_encode($result));
   
     return $response;
     
   }
   function showVideos(Request $request, Response $response, array $args){

      $result=VideosModel::getVideosById($args['id']);
     
       $response->getBody()->write(json_encode($result));
     
       return $response;
       
     }
     
     function showRooms(Request $request, Response $response, array $args){

      $user=UserModel::one_by_id($args['id']);

      if(count($user)>0 && $user['type']="teacher") {

      $result=UserRoomModel::obtieneClasesUsuario($args['id']);
      }else{
         $result=[];
      }
       $response->getBody()->write(json_encode($result));
     
       return $response;
       
     }
   
   }
   