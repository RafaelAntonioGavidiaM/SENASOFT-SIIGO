<?php

include_once "../modelo/juegoCrearModelo.php";

class crearJuego{

    public $usuario;
    public $codigo;


    public function ctrlCrearJuego(){

        $objRespuesta=modeloJuego::mdlCrearJuego($this->usuario, $this->codigo);
        echo json_encode($objRespuesta);








    }

    public function ctrlUnirsePartida(){

        $objRespuesta=modeloJuego::unirmePartida($this->codigo,$this->usuario);
        echo json_encode($objRespuesta);


    }






}

$objJuego = new crearJuego();

if(isset($_POST["nombreUsuario"]) && isset($_POST["codigo"])){

    $objJuego->usuario=$_POST["nombreUsuario"];
    $objJuego->codigo=$_POST["codigo"];

    $objJuego->ctrlCrearJuego();






}
if(isset($_POST["usuarioU"]) && isset($_POST["codigoUnion"])){

    $objJuego->codigo=$_POST["codigoUnion"];
    $objJuego->usuario=$_POST["usuarioU"];
    $objJuego->ctrlUnirsePartida();


}
