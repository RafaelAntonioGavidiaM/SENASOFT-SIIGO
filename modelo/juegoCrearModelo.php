<?php

require "conexion.php";
class modeloJuego{

    public static function mdlCrearJuego($usuario,$codigo){

        session_start();

        $registro="";

       
        $_SESSION["usuario"]=$usuario;
        $_SESSION["partida"]=$codigo;
        $estado="Espera";
        $ganador="";

        $objIngreso= conexion::conectar()->prepare("INSERT into partida(codigoPartida,estado,ganador) values (:c,:e,:g)");
        $objIngreso->bindParam(":c",$codigo,PDO::PARAM_STR);
        $objIngreso->bindParam(":e",$estado,PDO::PARAM_STR);
        $objIngreso->bindParam(":g",$ganador,PDO::PARAM_STR);

        if($objIngreso->execute()){

            $objIngreso= conexion::conectar()->prepare("SELECT idPartida from partida where codigoPartida=:c");
            $objIngreso->bindParam(":c",$codigo,PDO::PARAM_STR);
            $objIngreso->execute();
            $idPartida=$objIngreso->fetch();

            $id=$idPartida[0];
            $_SESSION["idPartida"]=$id;




          
            $registro = modeloJuego::IngresarNombredeUsuario($usuario,$id);



        }

        return $registro;





    







    }

    public static function IngresarNombredeUsuario($usuario,$codPartida){

        $mensaje="";
        $turno="";

        $objInsertarUsuario=conexion::conectar()->prepare("INSERT INTO usuarioPartida(nombre,idPartida,turno) values (:n,:id,:t) ");
        $objInsertarUsuario->bindParam(":n",$usuario,PDO::PARAM_STR);
        $objInsertarUsuario->bindParam(":id",$codPartida,PDO::PARAM_INT);
        $objInsertarUsuario->bindParam(":t",$turno,PDO::PARAM_STR);

        if($objInsertarUsuario->execute()){

            $mensaje="Partida Creada";



        }else{

            $mensaje="No se ha podido crear partida";
        }

        return $mensaje;


    }



}

