// Rafael
$(document).ready(function() {
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





        var traerCartas = "ok";

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


    // Edisson

    // Fin
});