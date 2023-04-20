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

Usuarios

get http://www.lingbook.cat.mialias.net/lingbook/users/all  -->devuelve todos los registros
post http://www.lingbook.cat.mialias.net/lingbook/users/new -->añadir un nuevo usuario
get http://www.lingbook.cat.mialias.net/lingbook/users/id   -->devuelve un solo usuario
post http://www.lingbook.cat.mialias.net/lingbook/users/login -->funcion para el loguinado.

Lenguajes

get http://www.lingbook.cat.mialias.net/lingbook/languages/all   -->devuelve todos los lenguajes
post http://www.lingbook.cat.mialias.net/lingbook/languages/new  -->crea un nuevo lenguaje
get http://www.lingbook.cat.mialias.net/lingbook/languages/id   -->devuelve un solo lenguaje

videos

get http://www.lingbook.cat.mialias.net/lingbook/videos/all   --> devuelve todos los videos
post http://www.lingbook.cat.mialias.net/lingbook/videos/new  -->para crear un nuevo video
get http://www.lingbook.cat.mialias.net/lingbook/videos/id    -->devuelve un solo video
