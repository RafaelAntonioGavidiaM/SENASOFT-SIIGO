<?php

include_once "../modelo/juegoEnProcesoModelo.php";

class controlJuegoProceso
{
    public $idPartida;

    public function traerCartas()
    {


        $objRespuesta = modeloJuego::mdlBarajearCartas($this->idPartida);
        echo json_encode($objRespuesta);
    }




}

$objJuegoProceso = new controlJuegoProceso();


if (isset($_POST["traerCartas"])) {

    $objJuegoProceso->idPartida= $_POST["traerCartas"];
    $objJuegoProceso->traerCartas();
}
