<?php
require "conexion.php";

class modeloEspero{


    public static function mdlCargarUsuarios(){
       // session_start();

        $idPartida=$_SESSION["idPartida"];

        $objConsulta =conexion::conectar()->prepare("SELECT * FROM usuarioPartida where idPartida=:id");

        $objConsulta->bindParam(":id",$idPartida,PDO::PARAM_INT);

        $objConsulta->execute();

        $lista= $objConsulta->fetchAll();
        return $lista;
        
    }




    
}