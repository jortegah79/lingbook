<?php
namespace App\Model;


use App\Model\User;

class UserModel extends MysqlModel{

 static $tabla="USERS";
 
 public static function create_user($data){
 
   $users= UserModel::one_by_mail($data['mail']);  
    if(count($users)==0){  
    $sql="insert into USERS (name,surname,mail,password,type,updated_at,created_at) values('" . $data['name'] . "','" . $data['surname'] . "','" . $data['mail']."','" . $data['password']. "','" . $data['type']. "','" . date('Y-m-d H:i:s') . "','" . date('Y-m-d H:i:s') . "')";
    return  UserModel::new($sql);  
  }else{
    return "";
  }
 } 
 public static function one_by_mail($mail){
  $sql="select * from USERS where mail='$mail'";    
  $data=MysqlModel::execute($sql);
  return count($data)>0?$data[0]:[];
}



}



