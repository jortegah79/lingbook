<?php

namespace App\Controllers;

require_once "./src/Model/config.php";

use App\Model\UserModel;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class LoginController
{


  function login(Request $request, Response $response, array $data)
  {
    $data=(array)$request->getParsedBody();    
    
    $user=UserModel::one_by_mail($data['mail']);

    if(UserModel::verify_pass($data['password'],$user['password'])){
         
    $tokenizador=require_once('./app/tokenizador.php');
    
    $user['type']=UserModel::devuelve_tipo($user['type']);

    $token=(string)$tokenizador('true',$user);

    $_SESSION['token']=$token;
    
    $response->getBody()->write($token);
    
    return $response;

    }else{

    $response->getBody()->write("error");
    
    return $response;

    }          
  }
  

}
