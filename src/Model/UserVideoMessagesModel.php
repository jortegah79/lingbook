<?php
namespace App\Model;

class UserVideoMessagesModel extends MysqlModel{

  /*Aqui generamos las variables estáticas que podamos necesitar y la de tabla  que sobreescribe a la variable tabla de la clase MysqlModel.
  Es la que usamos para determinar que tabla usaremos.*/
  static $tabla="USERS_VIDEOS_MESSAGES";
   

public static function addUserVideoMessage($data){
  
  $sql="insert into ".static::$tabla ." (id_video,id_user,id_message) values (".$data["id_video"].",".$data["id_user"].",".$data["id_message"].")";

  static::execute($sql);
}


  
}



