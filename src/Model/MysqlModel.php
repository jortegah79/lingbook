<?php

namespace App\Model;

use mysqli;

require_once "config.php";

class MysqlModel
{

  protected static $tabla = "ninguna";
  
  public function __contruct(){}

  public static function get_conection()
  {
    return new mysqli(HOSTNAME, USER, PASS, DATABASE);
  }


  public static function select()
  {
    $sql = "select * from " . static::$tabla;   
    return MysqlModel::execute($sql);    
   }

  public static function one($id){
    $sql="select * from " . MysqlModel::$tabla ." where id=$id";    
    $data=MysqlModel::execute($sql);
    return count($data)>0?$data[0]:[];
  }
  
  public static function execute($query){
    $result = MysqlModel::get_conection()->query($query);
    $data = [];
    while ($r = $result->fetch_assoc()) {
      $data[] = $r;
    }
    return $data;
  }

public static function new($query){ 
         MysqlModel::get_conection()->query($query); 
  return MysqlModel::get_conection()->insert_id;
}
}
