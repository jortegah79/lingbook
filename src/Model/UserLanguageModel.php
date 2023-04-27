<?php
namespace App\Model;


use App\Model\User;

class UserLanguageModel extends MysqlModel{

 
  /*Aqui generamos las variables estáticas que podamos necesitar y la de tabla  que sobreescribe a la variable tabla de la clase MysqlModel.
  Es la que usamos para determinar que tabla usaremos.*/
  static $tabla="USERS_LANGUAGES";
   
public static function addUserLang($data){

  $sql="insert into ".static::$tabla ." (id_users,id_language) values (".$data["id_users"].",".$data["id_languages"].")";

  static::execute($sql);
}

  
  
}



