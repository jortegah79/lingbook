<?php

namespace App\Model;


use App\Model\User;

class MessagesModel extends MysqlModel
{

  static $tabla = "MESSAGES";

public static function showAllMessages(){

  $sql="select m.*,uv.*,u.name,u.surname from ".static::$tabla ." m join USERS_VIDEOS_MESSAGES uv on uv.id_message=m.id_message join USERS u on u.id_user=uv.id_user ";

  return static::execute($sql);

}
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

    $sql="select m.*,u.id_user,u.id_video from ".static::$tabla ." m join USERS_VIDEOS_MESSAGES u on u.id_message=m.id_message where m.id_message='".$id."'";

    $data= static::execute($sql);

    return count($data)>0?$data[0]:$data;
  }
  public static function editMessage($id, $data)
  {

    $message = static::oneById($id);

    $status=isset($data['status'])?$data['status']:$message['status'];

    if (count($message) > 0) {

      $sql = "update " . static::$tabla . " set description='" . mb_convert_encoding($data['description'], 'UTF-8') . "', updated_at='" . date('Y-m-d H:i:s') . "', status='".$status."' where id_message=$id";
      
       static::execute($sql);       

       return static::oneById($id);

    }else{
      
      return false;
    }
  }

  public static function changeStatus($id)
  {

    $data = static::OneById($id);

    if (count($data) > 0) {

      $status = $data['status'] == 0 ? 1 : 0;

      $sql = "update " . static::$tabla . " set status=$status, updated_at='" . date('Y-m-d H:i:s') . "' where id_message=$id";

      return static::execute($sql);
      
    }else{
      return false;
    }
  }

  public static function getMessagesByIdUser($id): array
  {

    $user = UserModel::one_by_id($id);

    if (count($user) > 0) {

      $sql = "select m.*,u.id_user,u.id_video from ".static::$tabla ." m join USERS_VIDEOS_MESSAGES u on u.id_message=m.id_message where u.id_user='".$id."'";

      return static::execute($sql);

      
    }else{
      return "false";
    }
  }
  public static function getMessagesByIdVideo($id_video): array
  {

    $video = VideosModel::one_by_id($id_video);

    if (count($video) > 0) {

      $sql = "select m.*,u.id_user,u.name,u.surname from ".static::$tabla ." m join USERS_VIDEOS_MESSAGES uv on uv.id_message=m.id_message join USERS u on u.id_user=uv.id_user where uv.id_video='".$id_video."'";

      return static::execute($sql);
      
    }else{
      return "false";
    }
  }
}
