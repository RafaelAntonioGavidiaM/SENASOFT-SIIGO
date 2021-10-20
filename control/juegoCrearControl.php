<?php

include_once "../modelo/juegoCrearModelo.php";

class crearJuego{

    public $usuario;
    public $codigo;


    public function ctrlCrearJuego(){

        $objRespuesta=modeloJuego::mdlCrearJuego($this->usuario, $this->codigo);
        echo json_encode($objRespuesta);








    }






}

$objJuego = new crearJuego();

if(isset($_POST["nombreUsuario"]) && isset($_POST["codigo"])){

    $objJuego->usuario=$_POST["nombreUsuario"];
    $objJuego->codigo=$_POST["codigo"];

    $objJuego->ctrlCrearJuego();






}
