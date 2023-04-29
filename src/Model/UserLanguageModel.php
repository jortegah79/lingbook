<?php

namespace App\Model;


use App\Model\User;

class UserLanguageModel extends MysqlModel
{


  /*Aqui generamos las variables estáticas que podamos necesitar y la de tabla  que sobreescribe a la variable tabla de la clase MysqlModel.
  Es la que usamos para determinar que tabla usaremos.*/
  static $tabla = "USERS_LANGUAGES";

  public static function addUserLang($data): bool
  {

    $sql = "insert into " . static::$tabla . " (id_users,id_language) values (" . $data["id_users"] . "," . $data["id_languages"] . ")";

    return static::execute($sql);
  }
  public static function getLanguagesByIdUser($id): array|bool
  {

    $sql = "SELECT * FROM " . static::$tabla . " u join LANGUAGES l on l.id_language=u.id_language where u.id_users=$id";

    return static::execute($sql);
  }

  public static function getAlumnsByIdLanguage($id): array|bool
  {

    $sql = "SELECT id_user,name,surname,type status FROM " . static::$tabla . " ul join USERS u on ul.id_users=u.id_user where ul.id_language=$id && u.type='alumn'";

    return static::execute($sql);
  }

  public static function getTeachersByIdLanguage($id): array|bool
  {

    $sql = "SELECT id_user,name,surname,type status FROM " . static::$tabla . " ul join USERS u on ul.id_users=u.id_user where ul.id_language=$id && u.type='teacher'";

    return static::execute($sql);
  }
}
