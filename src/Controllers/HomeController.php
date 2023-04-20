<?php

namespace App\Controllers;

use App\Model\LanguagesModel;
use App\Model\UserModel;
use App\Model\VideosModel;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;


class HomeController{

  /**
   * Funcion para saludar por parte del equipo.
   */
  function index(Request $request,Response $response, array $data){

    $data=array(
      "Grup"=>"CATCODERS",
      "Producte"=>"LingBook",
      "Product Owner"=>"Juan Ortega",
      "Integrant 1"=>"Laura Baena",
      "Integrant 2"=>"Joan Ramon Nova",      
      "Integrant 3"=>"Nuria Masvidal",
      "Descripció"=>"Proyecte final de DAW pel curs 2022/2023"
    );

    $response->getBody()->write(json_encode($data));
    return $response;
  }

  /**
   * Borra las tablas
   */
  function delete_all(Request $request,Response $response, array $data){
   
    UserModel::trucate_table();
    LanguagesModel::truncate_all();
    VideosModel::truncate_all();
    $text="
    <H1>LAS TABLAS SIGUIENTES HAN SIDO BORRADAS </H1>
    <H2>USERS</H2>
    <H2>LANGUAGES</H2>
    <H2>VIDEOS</H2>";
    $response->getBody()->write($text);

    return $response;  
  }

  /*
   completa las tablas con los datos que hay en el archivo datos_bbdd;
  */
  function complete_all(Request $request,Response $response, array $data){
   
    $datas=require_once('./app/datos_bbdd.php');
    
    //renovamos los usuarios    
    foreach($datas['users'] as $d):
      UserModel::create_user($d);
    endforeach;

    //renovamos lenguages
    foreach($datas['lenguas'] as $d):
      LanguagesModel::create_language($d);      
    endforeach;
    
    //renovamos videos
    foreach($datas['videos'] as $d):
     
     VideosModel::create_video($d);
    endforeach;

$text="
<h1>Han sido introducido datos en las tablas:</h1>
<h2>USERS</h2>
<h2>VIDEOS</h2>
<h2>LANGUAGES</h2>
";
    $response->getBody()->write($text);
    return $response;
  }
  


}