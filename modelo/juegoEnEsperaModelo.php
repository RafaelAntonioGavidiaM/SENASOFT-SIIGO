<?php
require "conexion.php";

class modeloEspero{


    public static function mdlCargarUsuarios($idPartida){
       // session_start();

      

        $objConsulta =conexion::conectar()->prepare("SELECT * FROM usuarioPartida where idPartida=:id");

        $objConsulta->bindParam(":id",$idPartida,PDO::PARAM_INT);

        $objConsulta->execute();

        $lista= $objConsulta->fetchAll();
        return $lista;
        
    }




    
}