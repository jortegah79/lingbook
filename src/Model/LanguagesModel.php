<?php

namespace App\Model;

class LanguagesModel extends MysqlModel
{
  static $tabla = "LANGUAGES";

  /**
   * Function para registrar nuevos lenguajes. En caso de que el haya uno registrado, se devuelve un 1. Si no, se registra y devolvemos un 0.
   */
  public static function create_language($data)  {

    $users = LanguagesModel::one_by_name(strtolower($data['name']));

    if (count($users) == 0) {

      $sql = "insert into " . static::$tabla . " (name) values('" . $data['name'] . "')";

      return  LanguagesModel::new($sql);
    } else {
      return "1";
    }
  }

  //::::::::::::::::::::::::::::::::::::::::::::::::::.FUNCIONES EXTRAS PARA CONTROL::::::::::::::::::::::::::::::::::::::::::::::


  /**
   * Funcion especifica de lenguaje. Devuelve un 1 lenguaje por su nombre espeficado.
   */
  public static function one_by_name($name)
  {
    $name = strtolower($name);

    $sql = "select * from " . static::$tabla . " where name='$name'";

    $data = MysqlModel::execute($sql);

    return count($data) > 0 ? $data[0] : [];
  }


 /**
   * Funcion especifica de lenguaje. Devuelve un 1 lenguaje por su id espeficado.
   */
  public static function one_by_id($id)
  {
    $sql = "select * from " . static::$tabla . " where id_language='$id'";

    $data = MysqlModel::execute($sql);

    return count($data) > 0 ? $data[0] : [];
  }

  /*
  Funcion para elminar todos los datos de la tabla.
  */
   public static function truncate_all(){

    $sql="delete from ".static::$tabla." where 1=1";

    LanguagesModel::execute($sql);
    
  }

}
