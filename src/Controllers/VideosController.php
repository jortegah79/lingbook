<?php

namespace App\Controllers;


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
    $data = VideosModel::one_by_id($data['id']);

    $response->getBody()->write(json_encode($data));

    return $response;
  }

  /**
   * registra un video en la base de datos con el el link especificado.
   */
  function create(Request $request, Response $response, array $data)
  {
    $data =(array) $request->getParsedBody();   

    $id = VideosModel::create_video($data);   
    
    $response->getBody()->write(strval($id));
    
    return $response->withHeader('Access-Control-Allow-Origin', '*');
  }
}
