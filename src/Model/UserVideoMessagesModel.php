<?php

namespace App\Model;

class UserVideoMessagesModel extends MysqlModel
{

  static $tabla = "USERS_VIDEOS_MESSAGES";


  public static function addUserVideoMessage($data)
  {
    $sql = "insert into " . static::$tabla . " (id_video,id_user,id_message) values (" . $data["id_video"] . "," . $data["id_user"] . "," . $data["id_message"] . ")";
   
    return static::execute($sql);
  }

  public static function getUserVideoMessagesById($id): array
  {

    $sql = "SELECT id_user,v.*,m.* FROM ".static::$tabla." uvm join MESSAGES m on m.id_message=uvm.id_message join VIDEOS v on v.id_video=uvm.id_video where id_user=$id";

    return static::execute($sql);
  }
}
