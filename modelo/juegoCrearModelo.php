<?php

require "conexion.php";
class modeloJuego
{

    public static function mdlCrearJuego($usuario, $codigo)
    {



        $variables = [];


        $_SESSION["usuario"] = $usuario;
        $_SESSION["partida"] = $codigo;
        $estado = "Espera";
        $ganador = "";

        $objIngreso = conexion::conectar()->prepare("INSERT into partida(codigoPartida,estado,ganador) values (:c,:e,:g)");
        $objIngreso->bindParam(":c", $codigo, PDO::PARAM_STR);
        $objIngreso->bindParam(":e", $estado, PDO::PARAM_STR);
        $objIngreso->bindParam(":g", $ganador, PDO::PARAM_STR);

        if ($objIngreso->execute()) {

            $id = modeloJuego::buscarIdPartida($codigo);
            //$_SESSION["idPartida"]=$id;


            $variables[0] = $id;




            $registro = modeloJuego::IngresarNombredeUsuario($usuario, $id);
            $variables[1] = $registro;
            $variables[2] = $codigo;
        }

        return  $variables;
    }

    public static function validarCantidadJugadores($idPartida)
    {

        $objValidarPartida = conexion::conectar()->prepare("SELECT count(idUsuario) from usuarioPartida where idPartida=:idP");
        $objValidarPartida->bindParam(":idP", $idPartida, PDO::PARAM_INT);
        $objValidarPartida->execute();
        $cantidadJugadores = $objValidarPartida->fetch();
        $numeroJugadores = $cantidadJugadores[0];

        return $numeroJugadores;
    }


    public static function buscarIdPartida($codigoPartida)
    {
        $objIngreso = conexion::conectar()->prepare("SELECT idPartida from partida where codigoPartida=:c");
        $objIngreso->bindParam(":c", $codigoPartida, PDO::PARAM_STR);
        $objIngreso->execute();
        $idPartida = $objIngreso->fetch();

        $id = $idPartida[0];

        return $id;
    }

    public static function unirmePartida($codigo, $usuario)
    {
        $variable = [];

        $respuesta ="";
        $idPartida = modeloJuego::buscarIdPartida($codigo);

        $cantidadJugadores = modeloJuego::validarCantidadJugadores($idPartida);

        if ($cantidadJugadores < "4") {

            $idUsuario = modeloJuego::IngresarNombredeUsuario($usuario, $idPartida);
            $variable[0] = $idPartida;
            $variable[1] = $idUsuario;
            $variable[2] = $codigo;
            return $variable;
        } else {

            $respuesta = "sala llena";
            return $respuesta;
        }









        
    }

    public static function IngresarNombredeUsuario($usuario, $codPartida)
    {

        $mensaje = "";
        $turno = "";

        $objInsertarUsuario = conexion::conectar()->prepare("INSERT INTO usuarioPartida(nombre,idPartida,turno) values (:n,:id,:t) ");
        $objInsertarUsuario->bindParam(":n", $usuario, PDO::PARAM_STR);
        $objInsertarUsuario->bindParam(":id", $codPartida, PDO::PARAM_INT);
        $objInsertarUsuario->bindParam(":t", $turno, PDO::PARAM_STR);

        if ($objInsertarUsuario->execute()) {

            $mensaje = modeloJuego::buscaridJugador($usuario, $codPartida);
        } else {

            $mensaje = "Problema al ingresar a la partida";
        }

        return $mensaje;
    }

    public static function buscaridJugador($usuario, $codigoPartida)
    {
        // $id=modeloJuego::buscarIdPartida($codigoPartida);

        $objConsultarid = conexion::conectar()->prepare("SELECT idusuario from usuariopartida where nombre  = :n and idpartida = :p");
        $objConsultarid->bindParam(":n", $usuario, PDO::PARAM_STR);
        $objConsultarid->bindParam(":p", $codigoPartida, PDO::PARAM_INT);
        $objConsultarid->execute();
        $idUsuarioPartida = $objConsultarid->fetch();
        $usuario = $idUsuarioPartida[0];

        return $usuario;
    }
}
