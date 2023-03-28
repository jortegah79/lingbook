<?php

namespace App\Model;

class User
{

  private string $name;
  private string $surname;
  private string $email;
  private string $password;
  private string $type;
  private static const SALT = "LingbooK-users";
  private static const PROFESOR = "teacher";
  private static const ALUMNO = "alumn";
  private static const ADMINISTRADOR = "admin";

  public function __contruct__(string $name, string $surname, string $email, string $password, string $type = USER::ALUMNO)
  {

    $this->email = $email;
    $this->password = password_hash($password, User::SALT);
    $this->name = $name;
    $this->surname = $surname;
    $this->type = $type;
  }
  //::::::::::::::::::::::.   HACER  LOS GETTER Y LOS SETTERS ::::::::::::::::::::::::::::::::::::::::

  public function setName(String $name): void
  {
    $this->name = $name;
  }
  public function getName(): string
  {
    return $this->name;
  }
  public function setSurname(String $surname): void
  {
    $this->surname = $surname;
  }
  public function getSurname(): string
  {
    return $this->surname;
  }
  public function getEmail(): string
  {
    return $this->email;
  }
  public function setType(String $type): void
  {

    //deberia recibir un numero entero...0 ,1 o 2
    $this->type = $type;
  }
  public function getType(): string
  {
    return $this->type;
  }


  //:::::::::::::::::::::::::::::::::::::    MÉTODOS NO ESTÁTICOS :::::::::::::::::::::::::.

  public function save()
  {

    $tipo = User::devuelve_tipo($this->type);

    $bd = new Bbdd();
    $sql = "insert into USERS (name,surname,mail,password,type,updated_at,created_at) values('" . $this->name . "','" . $this->surname . "','" . $this->email . "','" . $this->password . "','" . $tipo . "','" . date('Y-m-d H:i:s') . "','" . date('Y-m-d H:i:s') . "')";
    $bd->get_conection()->query($sql);
   
  }


  //:::::::::::::::::::::::::::::::::::::    MÉTODOS ESTÁTICOS :::::::::::::::::::::::::.

  /**
   * Funcion que devuelve todos los usuarios.
   */
  public static function get_all()
  {
    $bd = Bbdd::get_conection();
    $sql = "select * from USERS";
    $data = array();
    $result = $bd->query($sql);
    while ($row = $result->fetch_assoc()) {
      $data[] = $row;
    }
    return $data;
  } 

  /**
   * Funcion para devolver el tipo
   */
  public static function devuelve_tipo(int $type): string
  {

    switch ($type) {
      case 0:
        return User::ADMINISTRADOR;
        break;
      case 1:
        return User::PROFESOR;
        break;
      case 2:
        return User::ALUMNO;
        break;
    }
  }
}
