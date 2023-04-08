<?php

namespace App\Controllers;


use App\Model\LanguagesModel;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class LanguagesController
{
/**
 * Funcion que sirve para mostrar todos los lenguajes
 */
  function show(Request $request, Response $response, array $data)
  {
    $data = LanguagesModel::select();

    $response->getBody()->write(json_encode($data));

    return $response;
  }
  
  /**
   * devuelve un lenguaje especificado
   */
  function getone(Request $request, Response $response, array $data)    
  {
    $data = LanguagesModel::one_by_id($data['id']);

    $response->getBody()->write(json_encode($data));

    return $response;
  }

  /**
   * crea un nuevo lenguaje con los datos pasados.
   */
  function create(Request $request, Response $response, array $data)
  {
    $data =(array) $request->getParsedBody();   

    $id = LanguagesModel::create_language($data);   
    
    $response->getBody()->write(strval($id));
    
    return $response->withHeader('Access-Control-Allow-Origin', '*');
  }
}