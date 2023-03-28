<?php

namespace App\Model;

use mysqli;

require_once "config.php";

class Bbdd{

  private mysqli $conexion;

  public function __contruct(){ }

  public static function get_conection(){
    
     return new mysqli(HOSTNAME,USER,PASS,DATABASE);
   
  
  }
}