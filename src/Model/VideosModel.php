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

    $sql = "insert into " . static::$tabla . " (link,likes,status) values('" . $data['link']."',0,0)";
      
    static::execute($sql);

    $id_video=static::getLast();
    
    $data['id_video']=$id_video[0]['id_video'];

    $result=UserVideoMessagesModel::addUserVideoMessage($data);

    return $result;
  }


  //::::::::::::::::::::::::::::::::::::::::::::::::::.FUNCIONES EXTRAS PARA CONTROL::::::::::::::::::::::::::::::::::::::::::::::

  public static function re_new_video($data):bool
  {

    $sql = "insert into " . static::$tabla . " (id_video,status,link,likes) values('".$data['id_video']."','" .$data['status']."','" . $data['link']."',0)";
     
      return  VideosModel::new($sql);
    
  }


 /**
   * Funcion especifica de lenguaje. Devuelve un 1 lenguaje por su id espeficado.
   */
  public static function one_by_id($id):array{

    $sql = "select * from " . static::$tabla . " where id_video='$id'";

    $data = MysqlModel::execute($sql);

    return count($data) > 0 ? $data[0] : [];

  }
  public static function changeStatus($id):bool{

    $video=static::one_by_id($id);

    if(count($video)>0){

      $status=$video[0]['status']==1?0:1;  
    
    $sql="update ".static::$tabla." set status=$status, updated_at='".date("Y-m-d H:i:s")."'";
    
    return static::execute($sql);
    
    }
  }
  public static function editVideo($id,$data):bool{
   
      $video=static::one_by_id($id);
  
      if(count($video)>0){
        
        $sql="update ".static::$tabla." set link='".$data['link']."', likes=".$data['likes'].", updated_at='".date('Y-m-d H:i:s')."', status='".$data['status']."' where id_video='".$id."'";
    
        return static::execute($sql);
      
      }
    }
public static function like($id):bool{

  $video=static::one_by_id($id);
  
  if(count($video)>0){
    
    $sql="update ".static::$tabla." set likes=likes +1 where id_video='".$id."'";

    return static::execute($sql);
  
  }

}

public static function getVideosById($id){

$user=UserModel::one_by_id($id);

if(count($user)>0 && $user[0]['type']=="teacher"){

$sql="select * from ".static::$tabla." v join USER_VIDEOS_MESSAGES uvm on uvm.id_video=v.id_video where uvm.id_user=$id";

return static::execute($sql);

}
return [];

}

  }
