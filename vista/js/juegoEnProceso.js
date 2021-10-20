// Rafael
$(document).ready(function() {
    $(".btnOcultarCartas").hide();

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
        $(".btnComenzar").fadeOut();
    });




    // Edisson

    // Fin
});