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
    
    foreach($data as $k=> $v){
   
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
    $data =(array) $request->getParsedBody();   

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

    $response->getBody()->write(json_encode($data));

    return $response;
  }




}
