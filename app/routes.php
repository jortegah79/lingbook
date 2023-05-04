<?php

use App\Controllers\AlumnController;
use Slim\App;
use App\Controllers\HomeController;
use App\Controllers\LoginController;
use App\Controllers\UserController;
use App\Controllers\LanguagesController;
use App\Controllers\MessageController;
use App\Controllers\TeacherController;
use App\Controllers\VideosController;

use App\Model\RoomModel;
use App\Model\UserLanguageModel;
use Slim\Routing\RouteCollectorProxy;

return function (App $app) {


  // LOCAL
  // localhost/lingbook/  

  // SERVIDOR
  //  http://www.lingbook.cat.mialias.net/lingbook/

  $app->get('/', HomeController::class . ':index'); //RUTA QUE MUESTRA DESCRIPCION DEL GRUPO

  // LOCAL
  // localhost/lingbook/users
  //SERVIDOR
  //  http://www.lingbook.cat.mialias.net/lingbook/users


  $app->group('/users', function (RouteCollectorProxy $group) { //GRUPO DE RUTAS PARA GESTION DE USERS
    $group->get('/all', UserController::class . ':show');  //muestra todos usuarios
    $group->get('/teachers',UserController::class.':teachers'); //devuelve un listado de profesores
    $group->post('/new', UserController::class . ':create'); //crea nuevo usuario  requiere(name,surname,mail,password,type ( puede ser 0/1/2))
    $group->get('/{id}',  UserController::class . ':getone');   //devuelve un usuario por su id
    $group->post('/login', LoginController::class . ':login'); //recibe un usuario y contraseña y devuelve un token
    $group->put('/{id}', UserController::class . ':edit'); //Edita el usuario escificado con los datos pasados.
    $group->delete('/{id}', UserController::class . ':changeStatus'); //cambia estado usuario-
  });


  // LOCAL
  // localhost/lingbook/languages
  //SERVIDOR
  //  http://www.lingbook.cat.mialias.net/lingbook/languages


  $app->group('/languages', function (RouteCollectorProxy $group) { //GRUPO DE RUTAS PARA GESTION DE LANGUAGES
    $group->get('/all', LanguagesController::class . ':show'); //muestra todos los lenguajes
    $group->post('/new', LanguagesController::class . ':create'); //crea un nuevo lenguaje requiere solo el nombre (name)
    $group->get('/id/{id}',  LanguagesController::class . ':getone');   //devuelve un lenguaje por su id
    $group->get('/name/{name}',  LanguagesController::class . ':getByName');   //devuelve un lenguaje por su nombre 
    $group->put('/{id}',  LanguagesController::class . ':edit');   //edita lenguage
    $group->get('/{id}/teachers', LanguagesController::class . ':getTeachers');
  });

  // LOCAL
  // localhost/lingbook/videos
  //SERVIDOR
  //  http://www.lingbook.cat.mialias.net/lingbook/videos


  $app->group('/videos', function (RouteCollectorProxy $group) { //GRUPO DE RUTAS PARA GESTION DE LANGUAGES
    $group->get('/all', VideosController::class . ':show'); //muestra todos los videos  
    $group->get('/{id}',  VideosController::class . ':getone');  //devuelve el video especificado por el id 
    $group->delete('/{id}',  VideosController::class . ':changeStatus');  //habilita o deshabilita el video con el id determinado
    $group->put('/{id}',  VideosController::class . ':edit');  //edita el video determinado por su id    
    $group->post('/{id}/{idUser}/message', VideosController::class . ':addMessage');
    $group->post('/{id}',  VideosController::class . ':like');  //añade like al video determinado 
  });


  /*::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::  LOS NUEVOS A DIA 24/04/2023:::::::::::::::*/

  $app->group('/messages', function (RouteCollectorProxy $group) {

    $group->get('/all', MessageController::class . ':show'); //muestra todos los mensajes
    $group->put('/{id}', MessageController::class . ':edit'); //edita el mensaje con el id especificado 
    $group->get('/{id}', MessageController::class . ':getMessage'); //devuelve el mensaje por el id pasado
    $group->delete('/{id}', MessageController::class . ':changeStatus');//cambia el estado del mensaje
    $group->get('/user/{id}',MessageController::class .':getMessageByUser'); //devuelve mensajes por usuario
  });



  $app->group('/teacher/{id}', function (RouteCollectorProxy $group) {
    $group->post('/video', VideosController::class . ':create'); //crea un nuevo video requiere solo el (link)  
    $group->get('/videos', TeacherController::class . ':showVideos'); //crea un nuevo video requiere solo el (link)  
    $group->post('/newclass', TeacherController::class . ':newRoom'); //añade un nuevo mensaje del profesor
    $group->get('/classes', TeacherController::class . ':showRooms'); //añade un nuevo mensaje del profesor
    $group->post('/lang/{id_lang}', TeacherController::class . ':newlang'); //añade un nuevo idioma del profesor
    $group->get('/lang', TeacherController::class . ':showLang'); //muestra el idioma del profesor
  });

  $app->group('/alumn/{id}', function (RouteCollectorProxy $group) {
    $group->post('/room/{id_room}', AlumnController::class . ':addToClass'); //añade un nuevo mensaje del profesor
    $group->get('/room', AlumnController::class . ':showRooms'); //añade un nuevo mensaje del profesor
    $group->get('/lang', AlumnController::class . ':showLangs'); //añade un nuevo mensaje del profesor
    $group->post('/lang/{id_lang}', AlumnController::class . ':addLang'); //añade un nuevo mensaje del profesor
    $group->delete('/lang/{id_lang}', AlumnController::class . ':delLang'); //añade un nuevo mensaje del profesor
    
  });




  //  $app->get('/videos/comments',VideosController::class.':getComments');

  /*::::::::::::::::::::::::::::::::::::::::::::::  hasta aqui :::::::::::::::::::::::::*/
  // LOCAL
  // localhost/lingbook/truncate_bbdd
  //SERVIDOR
  //  http://www.lingbook.cat.mialias.net/lingbook/users
  $app->get('/truncate_bbdd', HomeController::class . ':delete_all'); //esto elimina los datos de las tablas videos/users/languages

  // LOCAL
  // localhost/lingbook/renew_bbdd
  //SERVIDOR
  //  http://www.lingbook.cat.mialias.net/lingbook/renew_bbdd
  $app->get('/renew_bbdd', HomeController::class . ':complete_all'); //reconstruye los datos de las tablas users/videos/languages


};


//Hay que añadir a las tablas videos,messages,users la propiedad status que será 1 o 0. Da igual tinyint, boolean o varchar. Total, hay que mandar un json igualmente.