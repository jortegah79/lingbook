<?php

namespace App\Model;

use mysqli;


require_once "config.php";

class MysqlModel
{

  protected static $tabla = "ninguna";

  public function __contruct()
  {
  }

  public static function get_conection()
  {
    return new mysqli(HOSTNAME, USER, PASS, DATABASE);
  }

  //devuelve todos los elementos
  public static function select()
  {
    $sql = "select * from " . static::$tabla;

    return  static::execute($sql);

  }

  public static function execute($query)
  {
    $result = MysqlModel::get_conection()->query($query);
   
    if(is_bool($result)){    
      return $result;  

    }else{   
      $data = [];     
      while ($r = $result->fetch_assoc()) {     
        $data[] = $r;
      }
      return $data;
    }
  }
  /**
   * Funcion para crear un elemento nuevo en la tabla.
   */
  public static function new($query)
  {
    MysqlModel::get_conection()->query($query);
    return MysqlModel::get_conection()->insert_id;
  }

  public static function trucate_table(){

    $sql="delete from ".static::$tabla." where 1=1";
  
    return UserModel::execute($sql);
  
  }


  public static function getLast(String $order="updated_at"){
    
    $sql="select * from ".static::$tabla. " order by $order desc limit 1";

    return static::execute($sql);
  }
}
