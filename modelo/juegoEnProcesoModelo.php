<?php

class modeloJuego{

public static function modeloTraerCartas(){

    $objConsulta=conexion::conectar()->prepare("SELECT * FROM carta");

    $objConsulta->execute();

    $lista=$objConsulta->fetchAll();

    return $lista;




}

}

