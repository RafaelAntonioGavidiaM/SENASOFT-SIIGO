<?php

include_once "../modelo/juegoEnProcesoModelo.php";

class controlJuegoProceso
{
    public $idPartida;
    public $preguntaProgramador;
    public $preguntaModulo;
    public $preguntaError;
    public $idUsuario;



    public function traerCartas()
    {


        $objRespuesta = modeloJuego::mdlBarajearCartas($this->idPartida);
        echo json_encode($objRespuesta);
    }
    public function ctrListarCartasProgramador()
    {
        $objRespuesta = modeloJuego::mdlListarCartasProgramador();
        echo json_encode($objRespuesta);
    }
    public function ctrListarCartasModulo()
    {
        $objRespuesta = modeloJuego::mdlListarCartasModulo();
        echo json_encode($objRespuesta);
    }
    public function ctrListarCartasError()
    {
        $objRespuesta = modeloJuego::mdlListarCartasError();
        echo json_encode($objRespuesta);
    }
    public function ctrEnviarPregunta()
    {
        $objRespuesta = modeloJuego::mdlEnviarPregunta($this->preguntaProgramador, $this->preguntaModulo, $this->preguntaError,$this->idUsuario);
        echo json_encode($objRespuesta);
    }

    public function ctrlSenalar(){

        $objRespuesta=modeloJuego::mdlSenalar($this->preguntaProgramador, $this->preguntaModulo, $this->preguntaError,$this->idPartida);

        echo json_encode($objRespuesta);


    }



}

$objJuegoProceso = new controlJuegoProceso();


if (isset($_POST["traerCartas"])) {

    $objJuegoProceso->idPartida= $_POST["traerCartas"];
    $objJuegoProceso->traerCartas();
}

if (isset($_POST["cargarProgramador"]) == "ok") {
    $objJuegoProceso = new controlJuegoProceso();
    $objJuegoProceso->ctrListarCartasProgramador();
}
if (isset($_POST["cargarModulo"]) == "ok") {
    $objJuegoProceso = new controlJuegoProceso();
    $objJuegoProceso->ctrListarCartasModulo();
}
if (isset($_POST["cargarError"]) == "ok") {
    $objJuegoProceso = new controlJuegoProceso();
    $objJuegoProceso->ctrListarCartasError();
}
if (isset($_POST["preguntaProgramador"]) &&  isset($_POST["preguntaModulo"]) && isset($_POST["preguntaError"]) &&  isset($_POST["idUsuario"])) {
    $objJuegoProceso = new controlJuegoProceso();
    $objJuegoProceso->preguntaProgramador = $_POST["preguntaProgramador"];
    $objJuegoProceso->preguntaModulo = $_POST["preguntaModulo"];
    $objJuegoProceso->preguntaError = $_POST["preguntaError"];
    $objJuegoProceso->idUsuario=$_POST["idUsuario"];
    $objJuegoProceso->ctrEnviarPregunta();
}
if (isset($_POST["SpreguntaProgramador"]) &&  isset($_POST["SpreguntaModulo"]) && isset($_POST["SpreguntaError"]) &&  isset($_POST["SidPartida"])) {
    $objJuegoProceso = new controlJuegoProceso();
    $objJuegoProceso->preguntaProgramador = $_POST["SpreguntaProgramador"];
    $objJuegoProceso->preguntaModulo = $_POST["SpreguntaModulo"];
    $objJuegoProceso->preguntaError = $_POST["SpreguntaError"];
    $objJuegoProceso->idPartida=$_POST["SidPartida"];
    $objJuegoProceso->ctrlSenalar();
}

