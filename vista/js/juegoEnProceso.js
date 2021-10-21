// Rafael
$(document).ready(function () {

    const valores = window.location.search;
    const urlParams = new URLSearchParams(valores);

    var usuarioLocal = urlParams.get('usuario');
    var idPartida = urlParams.get('id');
    var codigo = urlParams.get('cod');
    $(".btnOcultarCartas").hide();
    $(".contenedorCartas").hide();
    $(".contenedor__revolver").hide();

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
        setTimeout(function() {
            $('#modalPregunta').modal('toggle');
        }, 4000);
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
                    alert("pregunta enviada");
                } else {
                    alert("No se pudo enviar la pregunta");
                }
            },
        });
    });


    // Edisson

    // Fin
});