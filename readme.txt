Esta es la api generada para el proyecto lingbook de los Catcoders(m12 grupo 8 para DAW -PROYECTO-)

Esta contruida en php slim. 

Esta parte es el backend y tiene una funcionalidad de mantener una serie de rutas activas para recibir y devolver datos.

El objetivo es que la parte de front-end pueda generar la funcionalidad completa pero teniendo un acceso cómodo a los datos guardados en la base de datos.

Recordar que para su uso hay que disponer de composer instalado.

Dejo aqui la página para la instalación

https://getcomposer.org/

Una vez indicado esto, decir que hay 2 rutas importantes.

1. Para eliminar los datos de la base de datos debemos usar la ruta
 
  localhost/lingbook/truncate_bbdd

2. Para rellenar la base de datos con datos para pruebas.

// localhost/lingbook/renew_bbdd

Además de esto, para el funcionamiento normal de la aplicación tenemos las diferentes rutas necesarias para apoyo a front-end.

Usuarios

get localhost/lingbook/users/all  -->devuelve todos los registros
post localhost/lingbook/users/new -->añadir un nuevo usuario
get localhost/lingbook/users/id   -->devuelve un solo usuario
post localhost/lingbook/users/login -->funcion para el loguinado.

Lenguajes

get localhost/lingbook/languages/all   -->devuelve todos los lenguajes
post localhost/lingbook/languages/new  -->crea un nuevo lenguaje
get localhost/lingbook/languages/id   -->devuelve un solo lenguaje

videos

get localhost/lingbook/videos/all   --> devuelve todos los videos
post localhost/lingbook/videos/new  -->para crear un nuevo video
get localhost/lingbook/videos/id    -->devuelve un solo video