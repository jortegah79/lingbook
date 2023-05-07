<?php

namespace App\Controllers;

use App\Model\UserModel;
use App\Model\LanguagesModel;
use App\Model\MessagesModel;
use App\Model\VideosModel;

use App\Model\RoomModel;
use App\Model\UserLanguageModel;
use App\Model\UserRoomModel;
use App\Model\UserVideoMessagesModel;

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
      "Product Owner"=>"Joan Ramon Nova",
      "Integrant 1"=>"Laura Baena",
      "Integrant 2"=>"Juan Ortega",      
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
   
    UserLanguageModel::trucate_table();
    UserVideoMessagesModel::trucate_table();
    UserRoomModel::trucate_table();
    RoomModel::trucate_table();

    UserModel::trucate_table();
    LanguagesModel::trucate_table();
    VideosModel::trucate_table();   
    MessagesModel::trucate_table();

    

    $text="
    <H1>LAS TABLAS SIGUIENTES HAN SIDO BORRADAS </H1>
    <h2>Usuarios</h2>
    <h2>Lenguas</h2>
    
    <h2>Videos</h2>
    <h2>classrooms</h2>
    
    <h2>Usuarios-classrooms-lenguas</h2>
    <h2>Mensajes</h2>
    
    <h2>Lengua-usuarios</h2>
    <h2>Users-Video-Mensaje</h2>";
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
      UserModel::re_new_user($d);
    endforeach;

    //renovamos lenguages
    foreach($datas['lenguas'] as $d):
      LanguagesModel::re_new_language($d);      
    endforeach;
     
  //renovamos videos
    foreach($datas['videos'] as $d): 
     
     VideosModel::re_new_video($d);
    endforeach;

     //creamos las rooms
    foreach($data['room'] as $d):
      RoomModel::re_new_room($d);
    endforeach;

    //renovamos la interseccion users,room,language
    foreach($data['usu_roo_lan'] as $d):
     UserRoomModel::add_to_class($d);
    endforeach;

    //renovamos insterseccion usuario room language
      foreach($datas['mensajes'] as $d):
      MessagesModel::re_new_message($d);     
    endforeach;

    //renovamos los user languages
      foreach($datas['user_languages'] as $d):
      UserLanguageModel::addUserLang($d);     
    endforeach;

    //renovamos los video users messages
     foreach($datas['vid_us_mes'] as $d):
      UserVideoMessagesModel::addUserVideoMessage($d);      
    endforeach;

    
    $text="
<h1>Han sido introducido datos en las tablas:</h1>
<h2>Usuarios</h2>
<h2>Lenguas</h2>

<h2>Videos</h2>
<h2>classrooms</h2>

<h2>Usuarios-classrooms-lenguas</h2>
<h2>Mensajes</h2>

<h2>Lengua-usuarios</h2>
<h2>Users-Video-Mensaje</h2>
";
    $response->getBody()->write($text);
    return $response;
  }
  
}