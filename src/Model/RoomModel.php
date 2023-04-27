<?php
namespace App\Model;

class RoomModel extends MysqlModel{

  /*Aqui generamos las variables estáticas que podamos necesitar y la de tabla  que sobreescribe a la variable tabla de la clase MysqlModel.
  Es la que usamos para determinar que tabla usaremos.*/
  static $tabla="ROOM";
   


public static function getAll(){

  $sql="select * from ".static::$tabla;

  return RoomModel::execute($sql);

}

public static function createRoom($data){

  $sql="insert into ".static::$tabla." (capacity,updated_at,description,DATA) values('".$data['capacity']."','".date('Y-m-d H:i:s')."','".mb_convert_encoding($data['description'], 'UTF-8')."','".$data['DATA']."')";

  RoomModel::execute($sql);
}
  /*Desde aquí describimos las posibles funciones de lectura y escritura contra tablas.*/
  
  
  
public static function re_new_room($data){

  $sql="insert into ".static::$tabla." (id_room,capacity,updated_at,description,DATA) values('".$data['id_room']."','".$data['capacity']."','".date('Y-m-d H:i:s')."','".$data['description']."','".$data['DATA']."')";

  RoomModel::execute($sql);
}
    
  
}



