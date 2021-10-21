<!DOCTYPE html>
<html lang="en">

<head>
  <title>Encuentra el Bug en el Sistema</title>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" />
  <link rel="stylesheet" href="vista/css/mesaJuego.css" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script src="https://cdn.socket.io/4.3.2/socket.io.min.js" integrity="sha384-KAZ4DtjNhLChOB/hxXuKqhMLYvx3b5MlT55xPEiNmREKRzeEm+RVPlTnAn0ajQNs" crossorigin="anonymous"></script>
  <script src="vista/js/juegoCrear.js"></script>
  <script src="vista/js/juegoEnEspera.js"></script>
  <script src="vista/js/juegoEnProceso.js"></script>
</head>

<body>
  <div class="contenedor">
    <div class="jugador1">
      <div class="contenedor__img">
        <img src="vista/img/jugador1.jpg" class="jugador1__img" alt="" />
      </div>
      <h1 class="jugador1__nombre" id="jugador1">Espera..</h1>
    </div>
    <div class="jugador2">
      <h1 class="jugador2__nombre" id="jugador2">Espera..</h1>
      <div class="contenedor__img">
        <img src="vista/img/jugador1.jpg" class="jugador2__img" alt="" />
      </div>
    </div>
    <div class="jugador3">
      <h1 class="jugador3__nombre" id="jugador3">Espera..</h1>
      <div class="contenedor__img">
        <img src="vista/img/jugador1.jpg" class="jugador3__img" alt="" />
      </div>
    </div>
    <div class="jugador4">
      <div class="contenedor__img">
        <img src="vista/img/jugador1.jpg" class="jugador4__img" alt="" />
      </div>
      <h1 class="jugador4__nombre" id="jugador4">Espera..</h1>
    </div>
    <h1 id="mesaNumero" class="mesaNumero">
      MESA N°
      <?php
      session_start();
      $codigo = $_SESSION["partida"];
      echo $codigo;

      ?>
    </h1>
    <div id="mostrarBoton"><input class="btnComenzar" type="button" value="Comenzar Partida" /></div>


    <div class="contenedor__revolver">
      <div class="cartaR primera">
        <div class="carta__frenteR">
          <h1 class="titulo__carta__frenteR">SIIGO</h1>
        </div>
        <div class="carta__atrasR">
          <div class="cabecera__cartaR">
            <img class="imagen__cartaR" src="vista/img/jugador1.jpg" alt="">
          </div>
          <h1 class="titulo__carta__atrasR">Nombre Carta</h1>
        </div>
      </div>
      <div class="cartaR segunda">
        <div class="carta__frenteR">
          <h1 class="titulo__carta__frenteR">SIIGO</h1>
        </div>
        <div class="carta__atrasR">
          <div class="cabecera__cartaR">
            <img class="imagen__cartaR" src="vista/img/jugador1.jpg" alt="">
          </div>
          <h1 class="titulo__carta__atrasR">Nombre Carta</h1>
        </div>
      </div>
      <div class="cartaR tercera">
        <div class="carta__frenteR">
          <h1 class="titulo__carta__frenteR">SIIGO</h1>
        </div>
        <div class="carta__atrasR">
          <div class="cabecera__cartaR">
            <img class="imagen__cartaR" src="vista/img/jugador1.jpg" alt="">
          </div>
          <h1 class="titulo__carta__atrasR">Nombre Carta</h1>
        </div>
      </div>
      <div class="cartaR usu1">
        <div class="carta__frenteR">
          <h1 class="titulo__carta__frenteR">SIIGO</h1>
        </div>
        <div class="carta__atrasR">
          <div class="cabecera__cartaR">
            <img class="imagen__cartaR" src="vista/img/jugador1.jpg" alt="">
          </div>
          <h1 class="titulo__carta__atrasR">Nombre Carta</h1>
        </div>
      </div>
      <div class="cartaR usu2">
        <div class="carta__frenteR">
          <h1 class="titulo__carta__frenteR">SIIGO</h1>
        </div>
        <div class="carta__atrasR">
          <div class="cabecera__cartaR">
            <img class="imagen__cartaR" src="vista/img/jugador1.jpg" alt="">
          </div>
          <h1 class="titulo__carta__atrasR">Nombre Carta</h1>
        </div>
      </div>
      <div class="cartaR usu3">
        <div class="carta__frenteR">
          <h1 class="titulo__carta__frenteR">SIIGO</h1>
        </div>
        <div class="carta__atrasR">
          <div class="cabecera__cartaR">
            <img class="imagen__cartaR" src="vista/img/jugador1.jpg" alt="">
          </div>
          <h1 class="titulo__carta__atrasR">Nombre Carta</h1>
        </div>
      </div>
      <div class="cartaR usu4">
        <div class="carta__frenteR">
          <h1 class="titulo__carta__frenteR">SIIGO</h1>
        </div>
        <div class="carta__atrasR">
          <div class="cabecera__cartaR">
            <img class="imagen__cartaR" src="vista/img/jugador1.jpg" alt="">
          </div>
          <h1 class="titulo__carta__atrasR">Nombre Carta</h1>
        </div>
      </div>
    </div>


    <!-- CONTENEDOR CARTAS USUARIO -->

    <div id="mostrarBoton"></div>

    <div class="col-sm-12 contenedorCartas">
      <h1 class="btnMostrarCartas">Mostrar Cartas</h1>
      <h1 class="btnOcultarCartas">Ocultar Cartas</h1>

      <div class="col-sm-3 carta">
        <div class="carta__frente">
          <h1 class="titulo__carta__frente">SIIGO</h1>
        </div>
        <div class="carta__atras">
          <div class="cabecera__carta">
            <img class="imagen__carta" src="vista/img/jugador1.jpg" alt="">
          </div>
          <h1>Nombre Carta</h1>
        </div>
      </div>

      <div class="col-sm-3 carta">
        <div class="carta__frente">
          <h1 class="titulo__carta__frente">SIIGO</h1>
        </div>
        <div class="carta__atras">
          <div class="cabecera__carta">
            <img class="imagen__carta" src="vista/img/jugador1.jpg" alt="">
          </div>
          <h1>Nombre Carta</h1>
        </div>
      </div>

      <div class="col-sm-3 carta">
        <div class="carta__frente">
          <h1 class="titulo__carta__frente">SIIGO</h1>
        </div>
        <div class="carta__atras">
          <div class="cabecera__carta">
            <img class="imagen__carta" src="vista/img/jugador1.jpg" alt="">
          </div>
          <h1>Nombre Carta</h1>
        </div>
      </div>

      <div class="col-sm-3 carta">
        <div class="carta__frente">
          <h1 class="titulo__carta__frente">SIIGO</h1>
        </div>
        <div class="carta__atras">
          <div class="cabecera__carta">
            <img class="imagen__carta" src="vista/img/jugador1.jpg" alt="">
          </div>
          <h1>Nombre Carta</h1>
        </div>
      </div>

    </div>

  </div>
  <div class="contenedorRandom">
    <div class="container">
      <div class="contenedorTuloRandom">
        <h1 class="tituloRamdom">Revolviendo Cartas</h1>
      </div>
      <center>
        <input class="btnSalirRandom" type="button" value="Parar" />
      </center>
    </div>
  </div>


  <div class="contenedorEspera">

    <div class="container">
      <div class="contenedorTuloEspera">
        <h1 class="tituloEspera">Partida En Espera</h1>
      </div>
      <center>
        <h1 id="mesaNumero" style="color: #fff;">
          MESA N°
          <?php
          // session_start();
          $codigo = $_SESSION["partida"];
          echo $codigo;

          ?>
        </h1>
      </center>
    </div>
  </div>
</body>

</html>