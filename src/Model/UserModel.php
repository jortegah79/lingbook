<?php

namespace App\Model;

class UserModel extends MysqlModel
{

  static $tabla = "USERS";
  const ADMINISTRADOR = "admin";
  const PROFESOR = "teacher";
  const ALUMNO = "alumn";

  /**
   * Function para registrar nuevos usuarios. En caso de que el correo ya se haya registrado, se devuelve un 1. Si no, se registra, encriptamos contraseña y devolvemos un 0.
   */
  public static function create_user($data): string
  {

    $users = UserModel::one_by_mail($data['mail']);

    if (count($users) == 0) {

      $tipo = static::devuelve_tipo($data['type']);

      $pass = static::crypt_pass($data['password']);

      $sql = "insert into USERS (name,surname,mail,password,type,updated_at,created_at,status) values('" . $data['name'] . "','" . $data['surname'] . "','" . $data['mail'] . "','" . $pass . "','" . $tipo . "','" . date('Y-m-d H:i:s') . "','" . date('Y-m-d H:i:s') . "',1)";

      UserModel::new($sql);

      return UserModel::getLast()[0]['id_user'];
    } else {

      return "0";
    }
  }


  public static function re_new_user($data): string
  {

    $users = UserModel::one_by_mail($data['mail']);

    if (count($users) == 0) {

      $tipo = static::devuelve_tipo($data['type']);

      $pass = static::crypt_pass($data['password']);

      $sql = "insert into USERS (id_user,name,surname,mail,status,password,type,updated_at,created_at) values('" . $data['id_user'] . "','" . $data['name'] . "','" . $data['surname'] . "','" . $data['mail'] . "','" . $data['status'] . "','" . $pass . "','" . $tipo . "','" . date('Y-m-d H:i:s') . "','" . date('Y-m-d H:i:s') . "')";

      return  UserModel::new($sql);
    } else {

      return "1";
    }
  }
  //::::::::::::::::::::::::::::::::::::::::::::::::::.FUNCIONES EXTRAS PARA CONTROL::::::::::::::::::::::::::::::::::::::::::::::


  /**
   * Funcion especifica de usuario. Devuelve un 1 usuario por el mail espeficado.
   */
  public static function one_by_mail($mail): array
  {

    $sql = "select * from USERS where mail='$mail' ";

    $data = MysqlModel::execute($sql);

    return count($data) > 0 ? $data[0] : [];
  }

  public static function editUser($id, $data)
  {

    $user = static::one_by_id($id);

    if (count($user) > 0) {

      $sql = "update " . static::$tabla . " set name='" . $data['name'] . "', surname='" . $data['surname'] . "', status='" . $data['status'] . "', updated_at='" . date('Y-m-d H:i:s') . "' where id_user=$id";

      return static::execute($sql);
    }
  }
  public static function changeStatus($id)
  {

    $user = static::one_by_id($id);

    if (count($user) > 0) {

      $status = $user['status'] == 0 ? 1 : 0;

      $sql = "update " . static::$tabla . " set status=" . $status . ", updated_at='" . date('Y-m-d H:i:s') . "' where id_user=$id";

      static::execute($sql);

      $messages=MessagesModel::getMessagesByIdUser($id);

       foreach($messages as $m):

          $m['status']=$status;

          MessagesModel::editMessage($m['id_message'],$m);

       endforeach;

       return true;
    }
    else{
      return false;
    }
  }

  /**
   * Funcion especifica de usuario. Devuelve un 1 usuario por el mail espeficado.
   */
  public static function one_by_id($id): array
  {

    $sql = "select * from USERS where id_user='$id'";

    $data = MysqlModel::execute($sql);

    return $data[0] ?? [];
  }

  /**
   * Funcion que nos devuelve el tipo de usuario para poder introducir en la tabla o para devolverselo al front-end
   */
  public static function devuelve_tipo(string $type): string
  {

    switch ($type) {
      case 0:
        return static::ADMINISTRADOR;
        break;
      case 1:
        return static::PROFESOR;
        break;
      case 2:
        return static::ALUMNO;
        break;
      case "admin":
        return "0";
        break;
      case "teacher":
        return "1";
        break;
      case "alumn":
        return "2";
        break;
    }
  }

  /**
   * Funcion que codifica la contraseña especificada
   */
  public static function crypt_pass($pass): string
  {

    $text = password_hash($pass, PASSWORD_BCRYPT);

    return $text;
  }
  /**
   * Funcion que verifica que la contraseña pasada es correcta.Devuelve true o false.
   */
  public static function verify_pass(string $pass, string $pass_saved): bool
  {

    return password_verify($pass, $pass_saved);
  }

  public static function getAllTeachers(){
    $data = static::select();

    $alumnos = [];
    foreach ($data as $d) :
      if ($d['type'] == "teacher") {
        array_push($alumnos, $d);
      }
    endforeach;
    return $alumnos;
  }
}
