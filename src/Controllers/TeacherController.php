<?php

namespace App\Controllers;

use App\Model\MessagesModel;
use App\Model\UserVideoMessagesModel;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class TeacherController{


   function newRoom(Request $request, Response $response, array $args){

    $data=(array)$request->getParsedBody();
   
     $result=MessagesModel::createMessage($data);
   
     $response->getBody()->write(json_encode($result));
   
     return $response;
     
   }
}