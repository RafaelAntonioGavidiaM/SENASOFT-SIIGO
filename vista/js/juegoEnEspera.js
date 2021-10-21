// Rafael
$(document).ready(function() {




    const valores = window.location.search;
    const urlParams = new URLSearchParams(valores);

    var usuarioLocal = urlParams.get('usuario');
    var idPartida = urlParams.get('id');
    var codigo = urlParams.get('cod');
    $("#mesaNumero").html(" MESA N°" + " " + codigo);
    console.log(usuarioLocal + " " + idPartida + " " + codigo);


    console.log(valores);

    $("#mostrarBoton").hide();

    var socket = io.connect("http://192.168.0.104:3000", { transports: ['websocket'] });
    socket.on('recargarUsuario', function(variable) {

        console.log(variable);


        if (variable == codigo) {
            cargarUsuarios(idPartida);

        }





    });

    cargarUsuarios(idPartida);


    function cargarUsuarios(id) {



        var cargarUsuarios = id;

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
            success: function(respuesta) {
                console.log(respuesta);




                for (let index = 0; index < respuesta.length; index++) {

                    if (index == 0) {
                        $("#jugador1").html(respuesta[index]["nombre"]);
                        console.log(usuarioLocal + " " + respuesta[index]["idUsuario"]);
                        $(".contenedorEspera").css("display", "block");
                        if (usuarioLocal == respuesta[index]["idUsuario"]) {
                            // $(".contenedorEspera").css("display", "none");


                            $("#mostrarBoton").show();

                        }




                    } else if (index == 1) {
                        $("#jugador2").html(respuesta[index]["nombre"]);
                        $(".contenedorEspera").css("display", "block");

                    } else if (index == 2) {
                        $("#jugador3").html(respuesta[index]["nombre"]);

                    } else if (index == 3) {
                        $("#jugador4").html(respuesta[index]["nombre"]);
                        $(".contenedorEspera").css("display", "block");

                        if (usuarioLocal == respuesta[0]["idUsuario"]) {

                            $(".contenedorEspera").css("display", "none");




                        }



                    }

                }





















            }



        })









    }





















})