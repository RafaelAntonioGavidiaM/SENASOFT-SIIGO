# SENASOFT-SIIGO - ENCUENTRA EL BUG EN EL SISTEMA

En este **README.md** encontraras información acerca del proyecto plasmado para la competición de **SENSOFT 2021** por la empresa **SIIGO.** 


# Estructura del proyecto

En la estructura del proyecto decidimos manejar distintas carpetas para separar los procesos que se llevan a cabo al hacer distintas acciones dentro la pagina web, las carpetas que utilizamos fueron 

 - Vista: En esta carpeta estamos manejando sub carpetas como pude ser las de CSS y IMG donde podemos encontramos los distintos diseños, imágenes y alertas plasmados en la pagina web, y la carpeta JS la cual maneja algo de diseño de la pagina, pero esta la utilizamos para poder manejar las acciones de los botones  y de los distintos datos de que se manejan dentro de los inputs.
 
 - Control: En esta carpeta esta compuesta de distintos archivos PHP 
   como podemos ver en la imagen cada uno de estos archivos esta organizado dependiendo el estado de la partida desde crear la partida hasta finalizar la partida, el cual esta encargado de recibir los datos que se envían desde el $.ajax de la carpeta vista y la sub carpeta de   JS.
 - Modelo: En esta carpeta esta compuesta por distintos archivos PHP el cual esta el archivo de conexion.php este esta encargado de hacer la conexión a la base de datos y el resto de archivos que también están organizados por el estado del juego es decir desde el momento que se esta creando la partida hasta que se finaliza la partida, cada uno de estos archivos son los que hacen las consultas requeridas para cada proceso a la base de datos y hace poder avanzar en el juego.
  - imgCartas: En esta carpeta se guarta todas las imagenes que ese utilizaron en la tabla carta y asi podiamos llamar la imagen en el apartado de mesajuego.php 

## Base de datos

La base de datos que utilizamos para realizar este proyecto fue MySQL, a continuación se mostrara el diseño de la base de datos que se utilizo para la realización de este proyecto con sus respectivas relaciones

## Node.js-Importante

Para este proyecto utilizamos el node.js el cual se tiene que descargar para hacer el funcionamiento debido al proyecto [Descargar node.js](https://nodejs.org/es/), una vez ya instalado el node.js en el equipo, encontramos una carpeta dentro del proyecto **SENASOFT-SIIGO** que se llama de la siguiente manera **serverSocket** esa carpeta **se debe sacar del proyecto** de **SENASOFT-SIIGO**ya que es un proyecto aparte que permite el inicio en el puerto 3000 en el CMD del sistema importante este proyecto debe estar en la carpeta htdocs de Xammp.

**Una vez la carpeta serverSocket** este en la carpeta htdocs como proyecto aparte ya podemos iniciar el socket.js que trae este proyecto, a continuación se hace la explicación de inicio de este socket

 1. Abrimos el CMD en administrador

 2. colocaremos la ruta que nos arroga el administrador de archivos hasta la carpeta htdocs.
  
 3. El siguiente paso es hacerle un `cd serverSocket` dentro del CMD del sistema. 
 
 5. Por ultimo vamos a iniciar el puerto 3000 solo colocando `node socket.js` en el CMD del sistema ya echo esto debe aparecer lo siguiente en pantalla `listening on *:3000`

 ## Servicios-XAMMP

Para los servicios de apache y MySQL utilizamos la herramienta llamada XAMMP la cual se puede descarga desde este link [Descargar XAMMP](https://www.apachefriends.org/es/index.html)










































