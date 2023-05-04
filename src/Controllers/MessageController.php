<?php

namespace App\Controllers;

use App\Model\MessagesModel;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class MessageController{

function show(Request $request, Response $response, array $args){

  $messages=MessagesModel::showAllMessages();

  $response->getBody()->write(json_encode($messages));

  return $response;
  
}

function edit(Request $request, Response $response, array $args){

  $id=$args['id'];

  $data=(array)$request->getParsedBody();
  
  $result=MessagesModel::editMessage($id,$data);

  $response->getBody()->write(json_encode($result));

  return $response;
  
}


function new(Request $request, Response $response, array $args){

 $data=(array)$request->getParsedBody();

  $result=MessagesModel::createMessage($data);

  $response->getBody()->write(json_encode($result));

  return $response;
  
}
function getMessage(Request $request, Response $response, array $args){

  $result=MessagesModel::oneById($args['id']);

  $response->getBody()->write(json_encode($result));

  return $response;
  
}

function changeStatus(Request $request, Response $response, array $args){

  $result=MessagesModel::changeStatus($args['id']);

  $response->getBody()->write(json_encode($result));

  return $response;
}
function getMessageByUser(Request $request, Response $response, array $args){

  $result=MessagesModel::getMessagesByIdUser($args['id']);

  $response->getBody()->write(json_encode($result));

  return $response;
  
}

}