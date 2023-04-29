<?php

namespace App\Model;

class LanguagesModel extends MysqlModel
{
  static $tabla = "LANGUAGES";

  /**
   * Function para registrar nuevos lenguajes. En caso de que el haya uno registrado, se devuelve un 1. Si no, se registra y devolvemos un 0.
   */
  public static function create_language($data):string
  {

    $users = LanguagesModel::oneByName(strtolower($data['name']));

    if (count($users) == 0) {

      $sql = "insert into " . static::$tabla . " (name) values('" . $data['name'] . "')";

      return  static::new($sql);
   
    } else {
  
      return "1";
 
    }
  }

  //::::::::::::::::::::::::::::::::::::::::::::::::::.FUNCIONES EXTRAS PARA CONTROL::::::::::::::::::::::::::::::::::::::::::::::


  public static function re_new_language($data):string
  {

    $users = LanguagesModel::oneByName(strtolower($data['name']));

    if (count($users) == 0) {

      $sql = "insert into " . static::$tabla . " (id_language,name) values('" . $data['id_language'] . "','" . $data['name'] . "')";

      return  static::new($sql);
   
    } else {
   
      return "1";
  
    }
  
  }


  /**
   * Funcion especifica de lenguaje. Devuelve un 1 lenguaje por su nombre espeficado.
   */
  public static function oneByName($name):array
  {
    $name = strtolower($name);

    $sql = "select * from " . static::$tabla . " where name='".$name."'";

    return static::execute($sql);
  
  }


  /**
   * Funcion especifica de lenguaje. Devuelve un 1 lenguaje por su id espeficado.
   */
  public static function oneById($id):array
  {
    $sql = "select * from " . static::$tabla . " where id_language='$id'";

    $data = static::execute($sql);

    return count($data) > 0 ? $data[0] : [];
  }

  public static function editLang($id, $name):bool
  {

    $lang = static::oneById($id);

    if (count($lang) > 0) {

      $sql = "update " . static::$tabla . " set name=$name where id_language=$id";

      return static::execute($sql);
    }
  }
}
