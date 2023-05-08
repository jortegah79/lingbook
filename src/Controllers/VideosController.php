<?php

namespace App\Controllers;

use App\Model\MessagesModel;
use App\Model\UserModel;
use App\Model\UserVideoMessagesModel;
use App\Model\VideosModel;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class VideosController
{

  /**
   * Muestra todos los videos que hay alojados en la aplicacion
   */
  function show(Request $request, Response $response, array $data)
  {
    $data = VideosModel::select();

    $response->getBody()->write(json_encode($data));

    return $response;
  }

  /**
   * Devuelve un video con el id especificado
   */
  function getone(Request $request, Response $response, array $data)
  {
    $data = VideosModel::getOneVideoWithTeacher($data['id']);

    $response->getBody()->write(json_encode($data));

    return $response;
  }

  /**
   * registra un video en la base de datos con el el link especificado.
   */
  function create(Request $request, Response $response, array $args)
  { 
    
    $user=UserModel::one_by_id($args['id']);
    
    if(count($user)>0 && $user['type']=="teacher"){
    
      $data = (array) $request->getParsedBody();

      $data['id_user']=$args['id'];
   
    $result = VideosModel::create_video($data);

    $response->getBody()->write(json_encode($result));

    }else{
      
      $response->getBody()->write(json_encode([]));
    }    

    return $response;
  }
  function changeStatus(Request $request, Response $response, array $data)
  {
    $id = $data['id'];

    $result = VideosModel::changeStatus($id);

    $response->getBody()->write(json_encode($result));

    return $response;
  }
  function edit(Request $request, Response $response, array $data)
  {
    $id = $data['id'];

    $data = (array) $request->getParsedBody();

    $result = VideosModel::editVideo($id,$data);

    $response->getBody()->write(json_encode($result));

    return $response;
  }


  function like(Request $request, Response $response, array $data)
  {
    $id=$data['id'];

    $result = VideosModel::like($id);

    $response->getBody()->write(json_encode($result));

    return $response;
  }


  function addMessage(Request $request, Response $response, array $args){
    
    $id=$args['id'];

    $data=(array)$request->getParsedBody();
   
    $id_user=$args['idUser'];
    
     $result=MessagesModel::createMessage($data);

     $id_message=MessagesModel::getLast()[0]['id_message'];

     $array=['id_user'=>$id_user,'id_video'=>$id,'id_message'=>$id_message];
    
     $result=UserVideoMessagesModel::addUserVideoMessage($array);
  
     $response->getBody()->write(json_encode($result));
   
     return $response;
     
   }
}
