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
 

  public function __contruct(string $name, string $surname, string $email, string $password, string $type=User::ALUMNO)
  {

    $this->email = $email;
    $this->password = password_hash($password, User::SALT);   
    $this->name = $name;
    $this->surname = $surname;
    $this->type = User::devuelve_tipo($type);
   
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

  //:::::::::::::::::::::::::::::::::::::    MÉTODOS ESTÁTICOS :::::::::::::::::::::::::.

  /**
   * Funcion para devolver el tipo
   */
  public static function devuelve_tipo(string $type): string
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

  public static function crypt_pass($pass){
    return password_hash($pass, User::SALT);   
  }
}
