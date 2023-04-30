<?php
namespace App\Model;


class UserRoomModel extends MysqlModel{

  /*Aqui generamos las variables estáticas que podamos necesitar y la de tabla  que sobreescribe a la variable tabla de la clase MysqlModel.
  Es la que usamos para determinar que tabla usaremos.*/
 static $tabla="USERS_ROOM_LANGUAGES";
   

public static function add_to_class($data):bool{
  
 $sql="select * from ".static::$tabla ." where id_user=".$data['id_user']." && id_room=".$data['id_room']." && id_language=".$data['id_language'];

 $class=static::execute($sql);
 if(count($class)>0){
  
  return false;
 }else{

  $sql="insert into ".static::$tabla ." (id_user,id_room,id_language) values ('".$data['id_user']."','".$data['id_room']."','".$data['id_language']."')";
  
  return UserRoomModel::execute($sql);
 }
}

public static function obtieneClasesUsuario($id):array{

  $user=UserModel::one_by_id($id);

  if(count($user)>0){

  $sql="SELECT r.*,l.* FROM USERS_ROOM_LANGUAGES url join LANGUAGES l on l.id_language=url.id_language join ROOM r on r.id_room=url.id_room join USERS u on u.id_user=url.id_user where url.id_user=$id";

  return  static::execute($sql);
  }

}
public static function obtieneUsuariosClase($id):array{

  $room=RoomModel::oneById($id);

  if(count($room)>0){

  $sql="SELECT r.*,l.* FROM USERS_ROOM_LANGUAGES url join LANGUAGES l on l.id_language=url.id_language join ROOM r on r.id_room=url.id_room join USERS u on u.id_user=url.id_user where url.id_room=$id";

  return  static::execute($sql);
  }

}
 
public static function getByIdRoom($id){

  $sql="select * from ".static::$tabla ." where id_room=$id";

  $data=static::execute($sql);

  return count($data)>0?$data[0]:$data;
}

}
