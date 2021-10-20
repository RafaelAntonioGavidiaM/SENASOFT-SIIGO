<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Encuentra el Bug en el Sistema</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link
      rel="stylesheet"
      href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"
    />
    <link rel="stylesheet" href="vista/css/mesaJuego.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.socket.io/4.3.2/socket.io.min.js" integrity="sha384-KAZ4DtjNhLChOB/hxXuKqhMLYvx3b5MlT55xPEiNmREKRzeEm+RVPlTnAn0ajQNs" crossorigin="anonymous"></script>
    <script src="vista/js/juegoCrear.js"></script>
    <script src="vista/js/juegoEnEspera.js"></script>
  </head>

  <body>
    <div class="contenedor">
      <div class="jugador1">
        <div class="contenedor__img">
          <img src="vista/img/jugador1.jpg" class="jugador1__img" alt="" />
        </div>
        <h1 class="jugador1__nombre" id="jugador1" idUsuario="" >Espera..</h1>
      </div>
      <div class="jugador2">
        <h1 class="jugador2__nombre" id="jugador2" idUsuario="">Espera..</h1>
        <div class="contenedor__img">
          <img src="vista/img/jugador1.jpg" class="jugador2__img" alt="" />
        </div>
      </div>
      <div class="jugador3">
        <h1 class="jugador3__nombre" id="jugador3" idUsuario="">Espera..</h1>
        <div class="contenedor__img">
          <img src="vista/img/jugador1.jpg" class="jugador3__img" alt="" />
        </div>
      </div>
      <div class="jugador4">
        <div class="contenedor__img">
          <img src="vista/img/jugador1.jpg" class="jugador4__img" alt="" />
        </div>
        <h1 class="jugador4__nombre" id="jugador4" idUsuario="">Espera..</h1>
      </div>
      <input class="btnComenzar" type="button" value="Comenzar Partida" />
      <div class="contenedorCartas">
        <h1 class="btnMostrarCartas">Mostrar Cartas</h1>
        <div class="carta">
          <div class="carta__frente">
            <h1>adelante</h1>
          </div>
          <div class="carta__atras">
            <h1>atras</h1>
          </div>
        </div>
      </div>
    </div>
    <div class="contenedorEspera">
      <h1 class="tituloEspera">Partida En Espera</h1>
    </div>

    <h1 id="mesaNumero">
      
    <?php
    session_start();
     $codigo =$_SESSION["partida"];
     echo $codigo;
    ?>
    </h1>

  </body>
</html>
