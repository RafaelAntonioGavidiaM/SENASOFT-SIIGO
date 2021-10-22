<?php

// use modeloJuego as GlobalModeloJuego;

use modeloJuego as GlobalModeloJuego;

require "conexion.php";
//include_once "juegoEnEsperaModelo.php";

class modeloJuego
{

    public $listaRestante = [];
    

    public static function modeloTraerCartas()
    {

        $objConsulta = conexion::conectar()->prepare("SELECT * FROM carta");

        $objConsulta->execute();

        $lista = $objConsulta->fetchAll();

        return $lista;
    }

    
    public static function mdlCargarUsuariosPartida($idPartida){
        // session_start();
 
       
 
         $objConsulta =conexion::conectar()->prepare("SELECT * FROM usuarioPartida where idPartida=:id");
 
         $objConsulta->bindParam(":id",$idPartida,PDO::PARAM_INT);
 
         $objConsulta->execute();
 
         $lista= $objConsulta->fetchAll();
         return $lista;
         
     }

    

    public static function  mdlInsertarCartas($programador, $modulo, $error, $idPartida)
    {



        $contadorR = 0;

        for ($i = 0; $i < 3; $i++) {



            if ($i == 0) {
                $objConsulta = conexion::conectar()->prepare("INSERT into cartaPartida(idPartida,idCarta) values (" . $idPartida . "," . $programador . ")");
                if ($objConsulta->execute()) {

                    $contadorR++;
                }
            } else if ($i == 1) {
                $objConsulta = conexion::conectar()->prepare("INSERT into cartaPartida(idPartida,idCarta) values (" . $idPartida . "," . $modulo . ")");
                if ($objConsulta->execute()) {

                    $contadorR++;
                }
            } else if ($i == 2) {
                $objConsulta = conexion::conectar()->prepare("INSERT into cartaPartida(idPartida,idCarta) values (" . $idPartida . "," . $error . ")");
                if ($objConsulta->execute()) {

                    $contadorR++;
                }
            }
        }

        return $contadorR;
    }


    public static function mdlBarajearCartas($idPartida)
    {

        $listaCartas = modeloJuego::modeloTraerCartas();
        $listaJugadores = modeloJuego::mdlCargarUsuariosPartida($idPartida);

        $desarrollador = [];
        $modulo = [];
        $error = [];
        $listaValoresRestantes=[];






        foreach ($listaCartas as $key => $value) {
            if ($value["idTipo"] == 1) {

                array_push($desarrollador, $value["idCarta"]);
            } else if ($value["idTipo"] == 2) {
                array_push($modulo, $value["idCarta"]);
            } else if ($value["idTipo"] == 3) {
                array_push($error, $value["idCarta"]);
            }
        }


        $programadorSecreto = $desarrollador[array_rand($desarrollador, 1)];

        $moduloSecreto = $modulo[array_rand($modulo, 1)];
        $errorSecreto = $error[array_rand($error, 1)];

        $insertar = modeloJuego::mdlInsertarCartas($programadorSecreto, $moduloSecreto, $errorSecreto, $idPartida);

        if ($insertar == 3) {

            $ciclos = count($listaCartas);

            for ($i = 0; $i < $ciclos; $i++) {

                $carta = $listaCartas[$i]["idCarta"];

                if ($carta == $moduloSecreto || $carta == $errorSecreto || $carta == $programadorSecreto) {
                } else {
                    array_push($listaValoresRestantes, $carta);
                }

            }

            
            
        

            $contadorRegistros=0;

            foreach ($listaJugadores as $key1 => $value1) {
                $usuario=$value1["idUsuario"];

                $cartasJugador=modeloJuego::sacarCartasJugador($listaValoresRestantes);

                foreach ($cartasJugador as $key2 => $value2) {
                    $idCarta=$value2;


                    $objConsulta = conexion::conectar()->prepare("INSERT into cartausuariopartida(idUsuario,idCarta) values (".$usuario.",".$idCarta.")");
                    if ($objConsulta->execute()) {
                        $contadorRegistros++;
                        for ($i=0; $i <count($listaValoresRestantes) ; $i++) { 
                            
                            if($idCarta==$listaValoresRestantes[$i]){
                                unset($listaValoresRestantes[$i]);
                               $restantes= array_values($listaValoresRestantes);

                               $listaValoresRestantes=$restantes;
                                break;

                            }
                        }



                    }



                }
            


               



            }

            

           





            return $cartasJugador;
        }
    }


    public static function sacarCartasJugador($array)
    {

        $cartaJugador=[];
        
      


        for ($i = 0; $i < 4; $i++) {

            $posicionRandom=array_rand($array, 1);

          $cartaJugador[$i]= $array[$posicionRandom] ;

          unset($array[$posicionRandom]);




          
        }

      

        return $cartaJugador;
    }


    public static function mdlListarCartasProgramador()
    {
        $objRespuesta = Conexion::conectar()->prepare("SELECT idCarta, nombreCarta FROM carta where idTipo=1");
        $objRespuesta->execute();
        $listarProgramadores = $objRespuesta->fetchAll();
        $objRespuesta = null;
        return $listarProgramadores;
    }
    public static function mdlListarCartasModulo()
    {
        $objRespuesta = Conexion::conectar()->prepare("SELECT idCarta, nombreCarta FROM carta where idTipo=2");
        $objRespuesta->execute();
        $listarProgramadores = $objRespuesta->fetchAll();
        $objRespuesta = null;
        return $listarProgramadores;
    }
    public static function mdlListarCartasError()
    {
        $objRespuesta = Conexion::conectar()->prepare("SELECT idCarta, nombreCarta FROM carta where idTipo=3");
        $objRespuesta->execute();
        $listarProgramadores = $objRespuesta->fetchAll();
        $objRespuesta = null;
        return $listarProgramadores;
    }
    public static function mdlEnviarPregunta($preguntaProgramador,$preguntaModulo,$preguntaError,$idUsuario)
    {
        $mensaje = "";
        try {
            $objRespuesta = Conexion::conectar()->prepare("INSERT INTO pregunta(preguntaProgramador,preguntaModulo,preguntaError,idUsuario)VALUES(:preguntaProgramador,:preguntaModulo,:preguntaError,:idUsuario)");
            $objRespuesta->bindParam(":preguntaProgramador", $preguntaProgramador, PDO::PARAM_STR);
            $objRespuesta->bindParam(":preguntaModulo", $preguntaModulo, PDO::PARAM_STR);
            $objRespuesta->bindParam(":preguntaError", $preguntaError, PDO::PARAM_STR);
            $objRespuesta->bindParam(":idUsuario", $idUsuario, PDO::PARAM_STR);
            if ($objRespuesta->execute()) {
                $mensaje = "ok";
            } else {
                $mensaje = "error";
            }
            $objRespuesta = null;
        } catch (Exception $e) {
            $mensaje = $e;
        }

        return $mensaje;
    }


    public static function consultarUltimaPregunta($idPartida){

        $objConsulta=conexion::conectar()->prepare("select idPregunta,pregunta.preguntaProgramador,preguntaModulo,preguntaError from pregunta inner join  usuariopartida on usuariopartida.idUsuario=pregunta.idUsuario inner join carta on carta.idCarta=pregunta.preguntaProgramador where usuariopartida.idPartida=".$idPartida." order by pregunta.idPregunta asc limit 1");
        $objConsulta->execute();
        $lista=$objConsulta->fetchAll();

        return $lista;



    }


    public static function mdlSenalar($preguntaProgramador,$preguntaModulo,$preguntaError,$idPartida){

        $objConsulta= conexion::conectar()->prepare("SELECT cartapartida.idCartaPartida,cartapartida.idCarta,carta.nombreCarta FROM reto.cartapartida  inner join carta on carta.idCarta=cartapartida.idCarta WHERE idPartida=".$idPartida." order by(idTipo)");
        $objConsulta->execute();
        $lista=$objConsulta->fetchAll();

        $contadorR=0;

        $contador2=0;

        foreach ($lista as $key => $value) {

            if($contador2==0){

                if($preguntaProgramador==$value["idCarta"]){
                    $contadorR++;

                }


            }else if($contador2==1){

                if($preguntaModulo==$value["idCarta"]){
                    $contadorR++;

                }

            }else if($contador2==2){

                if($preguntaError==$value["idCarta"]){

                    $contadorR++;
                }
            }

            $contador2++;
        }
            
            

            
        

$mensaje="";
        if($contadorR==3){
            $mensaje="Gano";

        }else{
            $mensaje="No";
        }

        return $mensaje;



    } 
    public static function mdlCargarCartaUsuario($idPartida,$idUsuario)
    {
        $objRespuesta = Conexion::conectar()->prepare("select carta.idCarta,carta.nombreCarta,carta.imagen from carta inner join cartausuariopartida on carta.idCarta=cartausuariopartida.idCarta where  cartausuariopartida.idUsuario=$idUsuario;");
        $objRespuesta->execute();
        $listaCartaUsuario = $objRespuesta->fetchAll();
        $objRespuesta = null;
        return $listaCartaUsuario;
    }

}
