<?php
namespace App\Model;


use App\Model\User;

class MessagesModel extends MysqlModel{

 static $tabla="MESSAGES";
     
 
public static function createMessage($data){

  $sql="insert into ".static::$tabla." (description,status) values('".$data('description')."','".$data['status']."')";

  static::execute($sql);
}
  /*Desde aquí describimos las posibles funciones de lectura y escritura contra tablas.*/
  
  
  
public static function re_new_message($data){

  
  $sql='insert into '.static::$tabla. ' (id_message,description,status) values('.$data["id_message"].',"'.mb_convert_encoding($data['description'], 'UTF-8').'","'.$data['status'].'")';


  static::execute($sql);
}
  








 
//::::::::::::::::::::::::::::::::::Funciones útiles para aportar control 

}



