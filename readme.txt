Esta es la api generada para el proyecto lingbook de los Catcoders(m12 grupo 8 para DAW -PROYECTO-)

Esta contruida en php slim. 

Esta parte es el backend y tiene una funcionalidad de mantener una serie de rutas activas para recibir y devolver datos.

El objetivo es que la parte de front-end pueda generar la funcionalidad completa pero teniendo un acceso cómodo a los datos guardados en la base de datos.

Recordar que para su uso hay que disponer de composer instalado.

Dejo aqui la página para la instalación

https://getcomposer.org/

Una vez indicado esto, decir que hay 2 rutas importantes.

1. Para eliminar los datos de la base de datos debemos usar la ruta
 
  http://www.lingbook.cat.mialias.net/lingbook/truncate_bbdd

2. Para rellenar la base de datos con datos para pruebas.

  http://www.lingbook.cat.mialias.net/lingbook/renew_bbdd

  Esta es la págian de inicio en la que mostramos el nombre del grupo y los integrantes del mismo
  
  http://www.lingbook.cat.mialias.net/www.lingbook.cat.mialias.net/lingbook/

Además de esto, para el funcionamiento normal de la aplicación tenemos las diferentes rutas necesarias para apoyo a front-end.
//:::::::::::::::::::::::::::::::::::::::://
              Usuarios
//:::::::::::::::::::::::::::::::::::::::://

get http://www.lingbook.cat.mialias.net/lingbook/users/all  -->devuelve todos los registros

Resultado: Array<Objeto>
[
  {
		"id_user": "27",
		"type": "2",
		"name": "test",
		"surname": "test",
		"mail": "test@test.es",
		"updated_at": "2023-04-30 12:42:52",
		"status": "1",
		"created_at": "2023-04-30 12:42:52"
	}
]
get http://www.lingbook.cat.mialias.net/lingbook/users/teachers  -->devuelve todos los profesores

Resultado: Array<Objeto>
[
  {
		"id_user": "27",
		"type": "1",
		"name": "test",
		"surname": "test",
		"mail": "test@test.es",
		"updated_at": "2023-04-30 12:42:52",
		"status": "1",
		"created_at": "2023-04-30 12:42:52"
	}
]

post http://www.lingbook.cat.mialias.net/lingbook/users/new -->añadir un nuevo usuario

Ejemplo json;
{
	"type":"2",
	"name":"test",
	"surname":"test",
	"mail":"test@test.es",
"password":"1234"	
}
resultado String: id 1 "0"

get http://www.lingbook.cat.mialias.net/lingbook/users/{id}   -->devuelve un solo usuario

Resultado: Objeto
{
		"id_user": "27",
		"type": "2",
		"name": "test",
		"surname": "test",
		"mail": "test@test.es",
		"updated_at": "2023-04-30 12:42:52",
		"status": "1",
		"created_at": "2023-04-30 12:42:52"
	}


post http://www.lingbook.cat.mialias.net/lingbook/users/login -->funcion para el loguinado.

ejemplo :
{
"mail":"test@test.es",
"password":"1234"	
}
resultado: String :TOKEN | "error"


put http://www.lingbook.cat.mialias.net/lingbook/users/{id}

ejemplo:
{	
	"name":"ESther",
	"surname":"Alvarita",
	"status":"1"	
}
resultado: true| false

delete http://www.lingbook.cat.mialias.net/lingbook/users/{id} // cambia el estado de 0 a 1 y de 1 a 0 según sea la situación actual
   
  Resultado: true|false



//:::::::::::::::::::::::::::::::::::::::::::::::://
                    Lenguajes
//:::::::::::::::::::::::::::::::::::::::::::::::://
get http://www.lingbook.cat.mialias.net/lingbook/languages/all   -->devuelve todos los lenguajes
Result: Array<Object>
[
{
		"id_language": "1",
		"name": "english"
	}  
]

post http://www.lingbook.cat.mialias.net/lingbook/languages/new  -->crea un nuevo lenguaje

Ejemplo:
{
	"name":"suajili"
}
Resultado: Id | "0"

get http://www.lingbook.cat.mialias.net/lingbook/languages/id/{id}   -->devuelve un solo lenguaje

Resultado: 
{
	"id_language": "15",
	"name": "suajili"
}
 error =[];
   
get http://www.lingbook.cat.mialias.net/lingbook/languages/name/{name}   -->devuelve un solo lenguaje
  --> name/suajili

Resultado:

{
	"id_language": "15",
	"name": "suajili"
}
error=[];

put http://www.lingbook.cat.mialias.net/lingbook/languages/{id}   -->editar un solo lenguaje

Ejemplo:
{
	"name": "suajili"
}

Resultado:true|false;

get http://www.lingbook.cat.mialias.net/lingbook/languages/{id}/teachers  devuelve los profesores por el id de lenguaje especificado

	Resultado: Array<Objeto>
	[
	{
		"id_user": "19",
		"name": "Alejandro",
		"surname": "Pérez",
		"status": "teacher"
	}
]
error=[];

//:::::::::::::::::::::::::::::::::::::://
							videos
//::::::::::::::::::::::::::::::::::::::://

get http://www.lingbook.cat.mialias.net/lingbook/videos/all   --> devuelve todos los videos

Resultado:
[
	{
		"id_video": "1",
		"link": "https:\/\/youtu.be\/O-sOjBpYJCM",
		"likes": "0",
		"updated_at": "2023-04-30 16:16:31",
		"status": "1",
		"created_at": "2023-04-30 16:16:31"
	}
]

get http://www.lingbook.cat.mialias.net/lingbook/videos/{id}   --> devuelve el video con el id especificado

Resultado: Object
{
	"id_video": "1",
	"link": "https:\/\/youtu.be\/O-sOjBpYJCM",
	"likes": "0",
	"updated_at": "2023-04-30 16:16:31",
	"status": "1",
	"created_at": "2023-04-30 16:16:31"
}

delete http://www.lingbook.cat.mialias.net/lingbook/videos/{id}   --> Habilita o deshabilita el video segun estado actual

Resultado:true|false;

put http://www.lingbook.cat.mialias.net/lingbook/videos/{id}   --> edita video especificado por id
    
Ejemplo:
{	
	"link": "https:\/\/youtu.be\/O-sOjBpYJCM",
	"likes": "0",
	"status": "1"	
}
Resultado:true |false

post  http://www.lingbook.cat.mialias.net/lingbook/videos/{id}/{idUser}/message   --> Para crear un nuevo mensaje a un video con el id de usuario determinado

Ejemplo:
{	
	"description":"Probando probando"
}

Resultado:true|false


post  http://www.lingbook.cat.mialias.net/lingbook/videos/{id}   --> añadir un like a un video

Resultado:true|false

//::::::::::::::::::::::::::::::::::::::::::::::::::://
									messages
//::::::::::::::::::::::::::::::::::::::::::::::::://

get  http://www.lingbook.cat.mialias.net/lingbook/messages/all   --> Devuelve todos los mensajes añadiendo el id de usuario de cada mensaje.

Resultado:Array<Objeto>

[
	{
		"id_message": "1",
		"description": "Word stress",
		"updated_at": "2023-05-03 22:43:58",
		"created_at": "2023-05-03 22:43:58",
		"status": "1",
		"id_user": "2"
	}
]

get  http://www.lingbook.cat.mialias.net/lingbook/messages/{id}  --> Devuelve el mensaje con el id especificado
Resultado:

  	{
		"id_message": "1",
		"description": "Gran video!Me aportó mucho.",
		"updated_at": "2023-04-30 16:16:31",
		"created_at": "2023-04-30 16:16:31",
		"status": "1"
	}
]

put  http://www.lingbook.cat.mialias.net/lingbook/messages/{id}  --> Edita el mensaje con el id especificado

Ejemplo:
{	
	"description":"Probando probando"
}
Resultado: true|false;

delete  http://www.lingbook.cat.mialias.net/lingbook/messages/{id}  --> Edita el mensaje con el id especificado
    
		Resultado:true|false;

get  http://www.lingbook.cat.mialias.net/lingbook/messages/user/{id} -->devuelve los mensajes del id de usuario especificado.

resultado:

[
	{
		"id_message": "26",
		"description": "Apuntaos al IOC....",
		"updated_at": "2023-05-03 22:43:58",
		"created_at": "2023-05-03 22:43:58",
		"status": "1",
		"id_user": "7"
	},
	{
		"id_message": "48",
		"description": "Dicen que aprender a los 50 es algo maravilloso. Lo corroboro.",
		"updated_at": "2023-05-03 22:43:58",
		"created_at": "2023-05-03 22:43:58",
		"status": "1",
		"id_user": "7"
	}
]
   get  http://www.lingbook.cat.mialias.net/lingbook/messages/video/{id_video} -->devuelve los mensajes del id de video especificado.

	 return :
[
	{
		"id_message": "4",
		"description": "Mini English lessons: Minimal pairs",
		"updated_at": "2023-05-03 22:43:58",
		"created_at": "2023-05-03 22:43:58",
		"status": "1",
		"id_user": "2"
	}
]


//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::://
					teachers
//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::://

post  http://www.lingbook.cat.mialias.net/lingbook/teacher/{id}/video  --> Crea un video con el mensaje hecho por un profe especificado por su id

Ejemplo:
{	
	"description":"How to improve your vocabulary",
	"link":"https://youtu.be/tCf6LWJToUc"
}
Resultado:true|false;

get  http://www.lingbook.cat.mialias.net/lingbook/teacher/{id}/videos //devuelve los videos creados por el profesor

Resultado:
[
{
		"id_video": "35",
		"link": "https:\/\/youtu.be\/tCf6LWJToUc",
		"likes": "0",
		"updated_at": "2023-04-30 19:34:54",
		"status": "1",
		"created_at": "2023-04-30 19:34:54",
		"id_user": "2",
		"id_message": "60"
	}	
]
post  http://www.lingbook.cat.mialias.net/lingbook/teacher/{id}/newclass //crea una nueva clase.

EJemplo:
{	
	"capacity":5,
	"description":"El link para la video clase es ....",
	"DATA":"2023-05-23 15:00:00"
}
delete  http://www.lingbook.cat.mialias.net/lingbook/teacher/{id}/class/{id_room} //borra una clase una nueva clase.






get  http://www.lingbook.cat.mialias.net/lingbook/teacher/{id}/classes //Devuelve todas las clases para el profe determinado con por la id

REsultado:
[
	{
		"id_room": "6",
		"capacity": "6",
		"updated_at": "2023-04-30 22:41:11",
		"description": "clase de italiano.Por favor, si finalmente no puedes asistir, deja libre para otro compañero.",
		"DATA": "2023-06-03 16:00:00",
		"id_language": "3",
		"name": "italian"
	}
]

post  http://www.lingbook.cat.mialias.net/lingbook/teacher/{id}/lang/{id_lang}  -->añade al profesor una lengua

result=true|false

get  http://www.lingbook.cat.mialias.net/lingbook/teacher/{id}/lang    -->muestra las lenguas del profesor
		return {
	"id_users": "21",
	"id_language": "7",
	"name": "russian"
}  


//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::://
								Alumn
//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::://

post  http://www.lingbook.cat.mialias.net/lingbook/alumn/{id}/room/{id_room} //Añade un alumno a una clase con el id de usuario y de la clase

Resultado:true|false

delete  http://www.lingbook.cat.mialias.net/lingbook/alumn/{id}/room/{id_room} //Desapunta un alumno de una clase con el id de usuario y de la clase


get  http://www.lingbook.cat.mialias.net/lingbook/alumn/{id}/room //Devuelve las clases de una persona
  
resultado:

[
	{
		"id_room": "1",
		"capacity": "5",
		"updated_at": "2023-05-03 22:43:58",
		"description": "clase de inglés.Por favor, si finalmente no puedes asistir, deja libre para otro compañero.",
		"DATA": "2023-05-22 15:00:00",
		"id_language": "1",
		"name": "english"
	}
]

post  http://www.lingbook.cat.mialias.net/lingbook/alumn/{id}/lang/{id_lang}  //el alumno sigue una lengua

resultado:
true|false




get  http://www.lingbook.cat.mialias.net/lingbook/alumn/{id}/lang //el alumno sigue una lengua

resultado:
[
	{
		"id_users": "5",
		"id_language": "6",
		"name": "japanese"
	}
]



delete  http://www.lingbook.cat.mialias.net/lingbook/alumn/{id}/lang/{id_lang} //el alumno deja de seguir una lengua

resultado:true | false
