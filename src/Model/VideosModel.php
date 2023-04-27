<?php

namespace App\Model;

class VideosModel extends MysqlModel
{

  static $tabla = "VIDEOS";


  /**
   * Function para registrar nuevos lenguajes. En caso de que el haya uno registrado, se devuelve un 1. Si no, se registra y devolvemos un 0.
   */
  public static function create_video($data)
  {

    $sql = "insert into " . static::$tabla . " (link,likes) values('" . $data['link']."',0)";
      
      return  VideosModel::new($sql);
    
  }


  //::::::::::::::::::::::::::::::::::::::::::::::::::.FUNCIONES EXTRAS PARA CONTROL::::::::::::::::::::::::::::::::::::::::::::::

  public static function re_new_video($data)
  {
    $sql = "insert into " . static::$tabla . " (id_video,status,link,likes) values('".$data['id_video']."','" .$data['status']."','" . $data['link']."',0)";
      
      return  VideosModel::new($sql);
    
  }


 /**
   * Funcion especifica de lenguaje. Devuelve un 1 lenguaje por su id espeficado.
   */
  public static function one_by_id($id){

    $sql = "select * from " . static::$tabla . " where id_video='$id'";

    $data = MysqlModel::execute($sql);

    return count($data) > 0 ? $data[0] : [];

  }

}
