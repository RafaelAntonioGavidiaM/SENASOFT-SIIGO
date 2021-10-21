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
}
