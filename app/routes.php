<?php

use Slim\App;
use App\Controllers\HomeController;
use App\Controllers\LoginController;
use App\Controllers\UserController;
use App\Controllers\LanguagesController;
use App\Controllers\VideosController;
use App\Model\RoomModel;
use App\Model\UserLanguageModel;
use Slim\Routing\RouteCollectorProxy;

return function (App $app) {


  // LOCAL
  // localhost/lingbook/  

  // SERVIDOR
  //  http://www.lingbook.cat.mialias.net/lingbook/

  $app->get('/',HomeController::class. ':index'); //RUTA QUE MUESTRA DESCRIPCION DEL GRUPO

  // LOCAL
  // localhost/lingbook/users
  //SERVIDOR
  //  http://www.lingbook.cat.mialias.net/lingbook/users


  $app->group('/users', function (RouteCollectorProxy $group) { //GRUPO DE RUTAS PARA GESTION DE USERS
    $group->get('/all', UserController::class . ':show');  //muestra todos usuarios
    $group->post('/new', UserController::class . ':create'); //crea nuevo usuario  requiere(name,surname,mail,password,type ( puede ser 0/1/2))
    $group->get('/{id}',  UserController::class . ':getone');   //devuelve un usuario por su id
    $group->post('/login', LoginController::class . ':login'); //recibe un usuario y contraseña y devuelve un token
  });
 

  // LOCAL
  // localhost/lingbook/languages
  //SERVIDOR
  //  http://www.lingbook.cat.mialias.net/lingbook/languages

  
  $app->group('/languages', function (RouteCollectorProxy $group) { //GRUPO DE RUTAS PARA GESTION DE LANGUAGES
    $group->get('/all', LanguagesController::class . ':show'); //muestra todos los lenguajes
    $group->post('/new', LanguagesController::class . ':create'); //crea un nuevo lenguaje requiere solo el nombre (name)
    $group->get('/{id}',  LanguagesController::class . ':getone');   //devuelve un lenguaje por su id
  });

  // LOCAL
  // localhost/lingbook/videos
  //SERVIDOR
  //  http://www.lingbook.cat.mialias.net/lingbook/videos
  
  
  $app->group('/videos', function (RouteCollectorProxy $group) { //GRUPO DE RUTAS PARA GESTION DE LANGUAGES
    $group->get('/all', VideosController::class . ':show'); //muestra todos los videos
    $group->post('/new', VideosController::class . ':create'); //crea un nuevo video requiere solo el (link)
    $group->get('/{id}',  VideosController::class . ':getone');  //devuelve el video especificado por el id 
  });

  
/*::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::  LOS NUEVOS A DIA 24/04/2023:::::::::::::::*/


 $app->group('/alumn/{id}',function(RouteCollectorProxy $group){

    $group->get('/langs',UserLanguageModel::class.'getAlumnLangs');
    $group->get('/classes',RoomModel::class.'getAlumnClasses');
    $group->get('/comments',UserLanguageModel::class.'getAlumnComments');
  });

  //$app->get('/langs/teachers',LanguagesController::class.':getTeachers');


  $app->group('/teacher/{id}',function(RouteCollectorProxy $group){
    
    $group->get('/videos',UserLanguageModel::class.'getAlumnLangs');
    $group->get('/classes',RoomModel::class.'getAlumnClasses');
    $group->get('/comments',UserLanguageModel::class.'getAlumnComments');

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