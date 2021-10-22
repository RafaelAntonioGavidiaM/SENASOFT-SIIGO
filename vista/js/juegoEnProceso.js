// Rafael
$(document).ready(function() {

    const valores = window.location.search;
    const urlParams = new URLSearchParams(valores);

    var usuarioLocal = urlParams.get('usuario');
    var idPartida = urlParams.get('id');
    var codigo = urlParams.get('cod');
    var usuarios = [];

    var siguienteJugador = 0;

    var socket = io.connect("http://localhost:3000", { transports: ['websocket'] });

    socket.on('recargarUsuario', function (variable) {

        console.log(variable);


        if (variable == codigo) {
            cargarUsuariosEnEjecucion(idPartida);


        }





    });

    socket.on('pregunta', function (variable) {

        var valores = variable.split(",");
        var idPartidaPr=valores[0];
        var idUsuarioPr=valores[1];

        if(idUsuarioPr==usuarioLocal){
            $(".contenedorEspera").css("display", "none");

            alert("Hola Jugador"+" "+usuarioLocal);
 


            buscarPregunta(idPartida);



        }


        


        





    });

    socket.on('turno2', function (variable) {

        console.log(variable);
        alert(variable);

        if (variable == usuarioLocal) {
            $(".contenedorEspera").css("display", "none");
            $(".contenedor__revolver").fadeIn(3000);
            setTimeout(function () {
                $(".contenedorRandom").css("top", "0px");
                $(".contenedorRandom").css("transition", "top 1s ease-in-out");
            }, 1000);

            setTimeout(function () {
                cargarComboError(1);
                cargarComboModulo(1);
                cargarComboProgramador(1);
                $('#modalPregunta').modal('toggle');

            }, 8000);

        }







    });





    socket.on('turno', function (variable) {




        var valores = variable.split(",");

        //alert(valores[0]+" "+ valores[1]);





        if (valores[1] == usuarioLocal && valores[0] == idPartida) {


            setTimeout(function() {
                cargarComboError(1);
                cargarComboModulo(1);
                cargarComboProgramador(1);
                $('#modalPregunta').modal('toggle');

            }, 8000);


        } else if (variable == "finalizado") {

            window.location.replace("index.html");
        }





    });








    $(".btnOcultarCartas").hide();
    $(".contenedorCartas").hide();
    $(".contenedor__revolver").hide();

    cargarUsuariosEnEjecucion(idPartida);


    function buscarPregunta(idPartida){

       

        var objData= new FormData();

        objData.append("consultarPregunta",idPartida);

        $.ajax({

            url:"control/juegoEnProcesoControl.php",
            type:"post",
            dataType:"json",
            data:objData,
            cache:false,
            contentType:false,
            processData:false,
            success: function(respuesta){

                console.log(respuesta);

                var cartas =new Array("0","Pedro","Juan","Carlos","Juanita","Antonio","Carolina","Manuel","Nomina","Facturación","Recibos","Comprobante contable","Usuarios","Contabilidad","404","Stack overflow","Memory out of range","Null pointer","Syntax error","Encoding error");

                var error=cartas[parseInt(respuesta[0][3])] ;
                var programador= cartas[parseInt(respuesta[0][1])];
                var modulo=cartas[parseInt(respuesta[0][2])];

                

                alert("Error "+" "+error+" Programador "+programador+" Modulo "+ modulo);
                var pregunta= "Error:  "+" "+error+" Programador: "+programador+" Modulo: "+ modulo +"?";


                 $("#preguntaLlega").html(pregunta);
                $("#modalRespuesta").modal('toggle');




                




            }
        })


    }





    function cargarUsuariosEnEjecucion(id) {



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



                var siguienteUsuario = "";
                var contador = 0;
                respuesta.forEach(cargarSiguiente);



                function cargarSiguiente(item, index) {

                    numeroJugadorLocal = Number(usuarioLocal);
                    numeroJugador = Number(item.idUsuario);



                    if (numeroJugadorLocal == numeroJugador) {

                        contador = index;







                    }





                }


                if (contador + 1 != 4) {
                    $("#btnPreguntar").attr("idSiguiente", respuesta[contador + 1][0]);
                    $("#btnSeñalar").attr("idSiguiente", respuesta[contador + 1][0]);
                    siguienteJugador = respuesta[contador + 1][0];



                } else {
                    $("#btnPreguntar").attr("idSiguiente", respuesta[0][0]);
                    $("#btnSeñalar").attr("idSiguiente", respuesta[0][0]);
                    siguienteJugador = respuesta[0][0];



                }











            }



        })









    }

    $("#btnSeñalar").click(function () {

        var preguntaProgramador = $("#selectProgramador").val();
        var preguntaModulo = $("#selectModulo").val();
        var preguntaError = $("#selectError").val();
        //  alert("PROGRAMADOR: " + preguntaProgramador + " " + "MODULO: " + preguntaModulo + " " + "ERROR: " + preguntaError)

        var objEnviarPreguntas = new FormData();
        objEnviarPreguntas.append("SpreguntaProgramador", preguntaProgramador);
        objEnviarPreguntas.append("SpreguntaModulo", preguntaModulo);
        objEnviarPreguntas.append("SpreguntaError", preguntaError);
        objEnviarPreguntas.append("SidPartida", idPartida);

        $.ajax({
            url: "control/juegoEnProcesoControl.php",
            type: "post",
            dataType: "json",
            data: objEnviarPreguntas,
            cache: false,
            contentType: false,
            processData: false,
            success: function (respuesta) {

                alert(respuesta);





                if (respuesta == "Gano") {

                    var finaliza = "finalizado";

                    socket.emit('turno', finaliza);


                } else {


                    alert(siguienteJugador);


                    socket.emit('turno2', siguienteJugador);
                    $(".contenedorEspera").css("display", "block");



                }


            }
        });

    })

    function cargarCartas() {
        var listarCartas = "ok";
        var objListarCartas = new FormData();
        objListarCartas.append("listarCartas", listarCartas);

        $.ajax({
            url: "",
            type: "post",
            dataType: "json",
            data: "",
            cache: false,
            contentType: false,
            processData: false,
            success: function(respuesta) {},
        });
    }

    // Diego

    $(".btnMostrarCartas").click(function() {
        $(".btnOcultarCartas").show();
        $(".btnMostrarCartas").hide();
        $(".contenedorCartas").css("transform", "translateY(-330px)");
        $(".contenedorCartas").css("transition", "transform 1s ease-in-out");
    });
    $(".btnOcultarCartas").click(function() {
        $(".btnOcultarCartas").hide();
        $(".btnMostrarCartas").show();
        $(".contenedorCartas").css("transform", "translateY(0px)");
        $(".contenedorCartas").css("transition", "transform 1s ease-in-out");
    });

    $(".btnComenzar").click(function() {
        $(".btnComenzar").hide();
        $(".contenedor__revolver").fadeIn(3000);
        setTimeout(function() {
            $(".contenedorRandom").css("top", "0px");
            $(".contenedorRandom").css("transition", "top 1s ease-in-out");
        }, 1000);




        var traerCartas = idPartida;

        var objData = new FormData();

        objData.append("traerCartas", traerCartas);

        $.ajax({
            url: "control/juegoEnProcesoControl.php",
            type: "post",
            dataType: "json",
            data: objData,
            cache: false,
            contentType: false,
            processData: false,
            success: function(respuesta) {


            }


        })

        var enviar = idPartida + "," + usuarioLocal;

        socket.emit('turno', enviar);

    });

    $(".btnSalirRandom").click(function() {
        $(".primera").addClass('s1');
        $(".segunda").addClass('s2');
        $(".tercera").addClass('s3');
        $(".usu1").addClass('u1');
        $(".usu2").addClass('u2');
        $(".usu3").addClass('u3');
        $(".usu4").addClass('u4');
        $(".contenedorRandom").css("top", "-970px");
        $(".contenedorRandom").css("transition", "top 1s ease-in-out");
        $(".contenedorCartas").fadeIn(6500);

        var partida = idPartida;
        var usuario = usuarioLocal;
        var objCargarCartasUsuario = new FormData();
        objCargarCartasUsuario.append("partida", partida);
        objCargarCartasUsuario.append("usuario", usuario);
        $.ajax({
            url: "control/juegoEnProcesoControl.php",
            type: "post",
            dataType: "json",
            data: objCargarCartasUsuario,
            cache: false,
            contentType: false,
            processData: false,
            success: function(objRespuesta) {
                var img1 = '<img class="imagen__carta" src="' + objRespuesta[0][2] + '" alt="">';
                var img2 = '<img class="imagen__carta" src="' + objRespuesta[1][2] + '" alt="">';
                var img3 = '<img class="imagen__carta" src="' + objRespuesta[2][2] + '" alt="">';
                var img4 = '<img class="imagen__carta" src="' + objRespuesta[3][2] + '" alt="">';
                console.log(img1);
                console.log(img2);
                console.log(img3);
                console.log(img4);
                $("#imagenCarta1").html(img1);
                $("#imagenCarta2").html(img2);
                $("#imagenCarta3").html(img3);
                $("#imagenCarta4").html(img4);
            }
        });
    });

    function cargarComboProgramador(opcion, principal, idCarta) {
        var cargarProgramador = "ok";
        var objCargarProgramador = new FormData();
        objCargarProgramador.append("cargarProgramador", cargarProgramador);
        $.ajax({
            url: "control/juegoEnProcesoControl.php",
            type: "post",
            dataType: "json",
            data: objCargarProgramador,
            cache: false,
            contentType: false,
            processData: false,
            success: function(objRespuesta) {
                if (opcion == 1) {
                    $("#selectProgramador").html("");
                    objRespuesta.forEach(cargarSelectProgramador);

                    function cargarSelectProgramador(item, index) {
                        $("#selectProgramador").append(
                            '<option value="' +
                            item.idCarta +
                            '">' +
                            item.nombreCarta +
                            "</option>"
                        );
                    }
                } else if (opcion == 2) {
                    var concatenar = "";
                    objRespuesta.forEach(cargarSelectProgramador);

                    function cargarSelectProgramador(item, index) {
                        if (item.idCarta == idCarta) {} else {
                            concatenar +=
                                '<option value="' +
                                item.idCarta +
                                '">' +
                                item.nombreCarta +
                                "</option>";
                        }
                    }
                    $("#selectProgramador").html(principal + concatenar);
                }
            },
        });
    }

    function cargarComboModulo(opcion, principal, idCarta) {
        var cargarModulo = "ok";
        var objCargarModulo = new FormData();
        objCargarModulo.append("cargarModulo", cargarModulo);
        $.ajax({
            url: "control/juegoEnProcesoControl.php",
            type: "post",
            dataType: "json",
            data: objCargarModulo,
            cache: false,
            contentType: false,
            processData: false,
            success: function(objRespuesta) {
                if (opcion == 1) {
                    $("#selectModulo").html("");
                    objRespuesta.forEach(cargarSelectModulo);

                    function cargarSelectModulo(item, index) {
                        $("#selectModulo").append(
                            '<option value="' +
                            item.idCarta +
                            '">' +
                            item.nombreCarta +
                            "</option>"
                        );
                    }
                } else if (opcion == 2) {
                    var concatenar = "";
                    objRespuesta.forEach(cargarSelectModulo);

                    function cargarSelectModulo(item, index) {
                        if (item.idCarta == idCarta) {} else {
                            concatenar +=
                                '<option value="' +
                                item.idCarta +
                                '">' +
                                item.nombreCarta +
                                "</option>";
                        }
                    }
                    $("#selectModulo").html(principal + concatenar);
                }
            },
        });
    }

    function cargarComboError(opcion, principal, idCarta) {
        var cargarError = "ok";
        var objCargarError = new FormData();
        objCargarError.append("cargarError", cargarError);
        $.ajax({
            url: "control/juegoEnProcesoControl.php",
            type: "post",
            dataType: "json",
            data: objCargarError,
            cache: false,
            contentType: false,
            processData: false,
            success: function(objRespuesta) {
                if (opcion == 1) {
                    $("#selectError").html("");
                    objRespuesta.forEach(cargarSelectError);

                    function cargarSelectError(item, index) {
                        $("#selectError").append(
                            '<option value="' +
                            item.idCarta +
                            '">' +
                            item.nombreCarta +
                            "</option>"
                        );
                    }
                } else if (opcion == 2) {
                    var concatenar = "";
                    objRespuesta.forEach(cargarSelectError);

                    function cargarSelectError(item, index) {
                        if (item.idCarta == idCarta) {} else {
                            concatenar +=
                                '<option value="' +
                                item.idCarta +
                                '">' +
                                item.nombreCarta +
                                "</option>";
                        }
                    }
                    $("#selectError").html(principal + concatenar);
                }
            },
        });
    }
    $("#btnPreguntar").click(function() {
        var preguntaProgramador = $("#selectProgramador").val();
        var preguntaModulo = $("#selectModulo").val();
        var preguntaError = $("#selectError").val();
        alert("PROGRAMADOR: " + preguntaProgramador + " " + "MODULO: " + preguntaModulo + " " + "ERROR: " + preguntaError)

        var objEnviarPreguntas = new FormData();
        objEnviarPreguntas.append("preguntaProgramador", preguntaProgramador);
        objEnviarPreguntas.append("preguntaModulo", preguntaModulo);
        objEnviarPreguntas.append("preguntaError", preguntaError);
        objEnviarPreguntas.append("idUsuario", usuarioLocal);

        $.ajax({
            url: "control/juegoEnProcesoControl.php",
            type: "post",
            dataType: "json",
            data: objEnviarPreguntas,
            cache: false,
            contentType: false,
            processData: false,
            success: function(respuesta) {
                if (respuesta == "ok") {

                    var enviaR=idPartida+","+siguienteJugador;

                    socket.emit('pregunta', enviaR);



                   

                } else {
                    alert("No se pudo enviar la pregunta");
                }
            },
        });
    });





    // Edisson

    // Fin
});