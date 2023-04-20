<?php

use Firebase\JWT\JWT;
use Firebase\JWT\Key;


/**
 * Funcion dedicada a la tokenización. Por defecto, sin valores, nos entrega un token con un tiempo determinado y los datos que le pasamos por el array
 * Si entregamos el valor false, y un token recibido, descomprime el token y comparará con el que haya guardado en la session.
 */
return function (bool  $tokenizar=true,$array,$token=""){
    
    $key = 'lingbook';
    if($tokenizar){    
  
$payload = [
    'iss' => 'Catcoders',
    'aud' => 'identify_users',
    'iat' => 1356999524,
    'nbf' => 1357000000,    
    'id_user' => $array['id_user'],
    'name'=> $array['name'],
    'surname'=>$array['surname'],
    'mail'=>$array['mail'],
    'type'=>$array['type']
];

return $jwt = JWT::encode($payload, $key, 'HS256');

}else{
    $jwt=$token;
    $decoded_array = (array)JWT::decode($jwt, new Key($key, 'HS256'));

}
};

