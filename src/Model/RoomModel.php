<?php
namespace App\Model;

class RoomModel extends MysqlModel{

  /*Aqui generamos las variables estáticas que podamos necesitar y la de tabla  que sobreescribe a la variable tabla de la clase MysqlModel.
  Es la que usamos para determinar que tabla usaremos.*/
  static $tabla="ROOM";
   


public static function createRoom($data){

   $fecha=is_numeric($data['DATA'])?date('Y-m-d H:i',$data['DATA']):date('Y-m-d H:i',strtotime($data['DATA']));
  
  $sql="insert into ".static::$tabla." (capacity,updated_at,description,DATA) values('".$data['capacity']."','".date('Y-m-d H:i:s')."','".mb_convert_encoding($data['description'], 'UTF-8')."','".$fecha."')";

   RoomModel::execute($sql);

    return static::getLast()[0]['id_room'];
    
}
  /*Desde aquí describimos las posibles funciones de lectura y escritura contra tablas.*/
  
  
  
public static function re_new_room($data):bool{

  $sql="insert into ".static::$tabla." (id_room,capacity,updated_at,description,DATA) values('".$data['id_room']."','".$data['capacity']."','".date('Y-m-d H:i:s')."','".mb_convert_encoding($data['description'], 'UTF-8')."','".$data['DATA']."')";

  return RoomModel::execute($sql);
}

public static function oneById($id):array{

  $sql="select * from ".static::$tabla ." where id_room=$id";

  return static::execute($sql);

}

public static function updateRoom($id,$data):bool{

  $room=static::oneById($id);

  if(count($room)>0){

  $sql="update ".static::$tabla." set capacity='".$data['capacity']."', updated_at='".date("Y-m-d H:i:s")."', description='".mb_convert_encoding($data['description'], 'UTF-8')."', DATA='".$data['DATA']."'";

  return static::execute($sql);
  }
}
public static function deleteRoom($id):bool{


  $room=static::oneById($id);

  if(count($room)>0){

  $sql="delete from ".static::$tabla." where id_room='".$id."'";

  return static::execute($sql);

  }else{

    return "false";
    
  }
}
   
}



