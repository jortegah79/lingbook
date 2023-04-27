<?php
namespace App\Model;


class UserRoomModel extends MysqlModel{

  /*Aqui generamos las variables estáticas que podamos necesitar y la de tabla  que sobreescribe a la variable tabla de la clase MysqlModel.
  Es la que usamos para determinar que tabla usaremos.*/
 static $tabla="USERS_ROOM_LANGUAGES";
   
public static function getAll(){

  $sql="select * from ".static::$tabla;

  return UserRoomModel::execute($sql);
}

public static function add_to_class($data){

  
  $sql="insert into ".static::$tabla ." (id_user,id_room,id_language) values ('".$data['id_user']."','".$data['id_room']."','".$data['id_language']."')";

  UserRoomModel::execute($sql);

}


}



