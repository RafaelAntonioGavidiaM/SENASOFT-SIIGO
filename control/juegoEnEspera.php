<?php

include_once "../modelo/juegoEnEsperaModelo.php";
class esperaControl{

    public $codigoPartida;
    public $idPartida;

public function cargarUsuarios(){

    $objRespuesta= modeloEspero::mdlCargarUsuarios($this->idPartida);
    echo json_encode($objRespuesta);


}



}

$objEspera = new esperaControl();

if(isset($_POST["cargarUsuarios"])){
    

    $objEspera->idPartida=$_POST["cargarUsuarios"];
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

