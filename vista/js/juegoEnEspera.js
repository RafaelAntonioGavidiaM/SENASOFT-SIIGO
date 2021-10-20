// Rafael
$(document).ready(function () {



 const valores =  window.location.search;
 const urlParams = new URLSearchParams(valores);

 var usuarioLocal=urlParams.get('usuario');
 console.log(usuarioLocal);


 console.log(valores);


    var socket = io.connect("http://localhost:3000", { transports: ['websocket'] });
    socket.on('recargarUsuario', function (variable) {


        validarUnion(variable);



    });

    cargarUsuarios();


    function cargarUsuarios() {



        var cargarUsuarios = "ok";

        var objData = new FormData();


        objData.append("cargarUsuarios", cargarUsuarios);


        $.ajax({
            url: "control/juegoEnEspera.php",
            type: "post",
            dataType: "json",
            data: objData,
            cache: false,
            contentType: false,
            processData: false,
            success: function (respuesta) {
                console.log(respuesta);




                for (let index = 0; index < respuesta.length; index++) {

                    if (index == 0) {
                        $("#jugador1").html(respuesta[index]["nombre"]);
                        console.log(usuarioLocal+" "+respuesta[index]["idUsuario"]);
                        $(".contenedorEspera").css("display", "block");
                        if(usuarioLocal==respuesta[index]["idUsuario"]){
                           // $(".contenedorEspera").css("display", "none");
                            var boton ='<input class="btnComenzar" type="button" value="comenzar Partida"/>';

                            $("#mostrarBoton").html(boton);

                        }
                        



                    } else if (index == 1) {
                        $("#jugador2").html(respuesta[index]["nombre"]);
                        $(".contenedorEspera").css("display", "block");

                    } else if (index == 2) {
                        $("#jugador3").html(respuesta[index]["nombre"]);

                    } else if (index == 3) {
                        $("#jugador4").html(respuesta[index]["nombre"]);

                    }

                }





















            }



        })









    }


    function validarUnion(partida) {

        var objData = new FormData();
        objData.append("partida", partida);

        $.ajax({
            url: "control/juegoEnEspera.php",
            type: "post",
            dataType: "json",
            data: objData,
            cache: false,
            contentType: false,
            processData: false,
            success: function (respuesta) {


                console.log(respuesta);

                usuarioPrincipal = respuesta[0]["nombre"];




                for (let index = 0; index < respuesta.length; index++) {

                    if (index == 0) {
                        console.log(usuarioLocal+" "+respuesta[index]["idUsuario"]);
                        $("#jugador1").html(respuesta[index]["nombre"]);
                        
                        
                       




                    } else if (index == 1) {
                        $("#jugador2").html(respuesta[index]["nombre"]);
                        $(".contenedorEspera").css("display", "block");
                      


                    } else if (index == 2) {
                        $("#jugador3").html(respuesta[index]["nombre"]);
                        $(".contenedorEspera").css("display", "block");
                        

                    } else if (index == 3) {
                        $("#jugador4").html(respuesta[index]["nombre"]);
                        $(".contenedorEspera").css("display", "block");
                        if(usuarioLocal==respuesta[0]["idUsuario"]){
                            $(".contenedorEspera").css("display", "none");
                           

                           

                        }


                        






                    }

                }


            }



        })









    }

    











})




