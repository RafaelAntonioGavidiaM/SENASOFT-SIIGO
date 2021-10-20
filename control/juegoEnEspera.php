<?php

include_once "../modelo/juegoEnEsperaModelo.php";
class esperaControl{

public function cargarUsuarios(){

    $objRespuesta= modeloEspero::mdlCargarUsuarios();
    echo json_encode($objRespuesta);


}

}

$objEspera = new esperaControl();

if(isset($_POST["cargarUsuarios"])){

    $objEspera->cargarUsuarios();



}