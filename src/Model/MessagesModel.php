<?php

namespace App\Model;


use App\Model\User;

class MessagesModel extends MysqlModel
{

  static $tabla = "MESSAGES";


  public static function createMessage($data):void {

    $sql = "insert into " . static::$tabla . " (description,status) values('" . mb_convert_encoding($data['description'], 'UTF-8') . "',1)";

   static::execute($sql);
    
  }
 
  public static function re_new_message($data): bool
  {


    $sql = 'insert into ' . static::$tabla . ' (id_message,description,status) values(' . $data["id_message"] . ',"' . mb_convert_encoding($data['description'], 'UTF-8') . '","' . $data['status'] . '")';


    return static::execute($sql);
  }

  public static function oneById($id): array
  {

    $sql = "select * from " . static::$tabla . " where id_message=$id";

    $data= static::execute($sql);

    return count($data)>0?$data[0]:$data;
  }
  public static function editMessage($id, $data): array
  {

    $message = static::OneById($id);

    if (count($message) > 0) {

      $sql = "update " . static::$tabla . " set description='" . mb_convert_encoding($data['description'], 'UTF-8') . "', updated_at='" . date('Y-m-d H:i:s') . "' where id_message=$id";

      $data=static::execute($sql);

      return count($data)>0?$data[0]:$data;
    }
  }

  public static function changeStatus($id): bool
  {

    $data = static::OneById($id);

    if (count($data) > 0) {

      $status = $data['status'] == 0 ? 1 : 0;

      $sql = "update " . static::$tabla . " set status=$status, updated_at='" . date('Y-m-d H:i:s') . "' where id_message=$id";

      return static::execute($sql);
    }
  }
}
