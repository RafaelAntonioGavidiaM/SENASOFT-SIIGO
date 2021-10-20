<?php

include_once "../modelo/juegoEnEsperaModelo.php";
class esperaControl{

    public $codigoPartida;

public function cargarUsuarios(){

    $objRespuesta= modeloEspero::mdlCargarUsuarios();
    echo json_encode($objRespuesta);


}



}

$objEspera = new esperaControl();

if(isset($_POST["cargarUsuarios"])){
    session_start();

    $objEspera->cargarUsuarios();



} 
if(isset($_POST["partida"])){

    session_start();

  $codigoPartida=  $_SESSION["partida"];
  $codigoPartidaLlegada=$_POST["partida"];
  
   

  if($codigoPartida==$codigoPartidaLlegada){

    $objEspera->cargarUsuarios();
    




  }






}

if(isset($_POST["consultaUsuarioLocal"])){

    session_start();

    $usuario=$_SESSION["usuario"];
    echo json_encode($usuario);




}

