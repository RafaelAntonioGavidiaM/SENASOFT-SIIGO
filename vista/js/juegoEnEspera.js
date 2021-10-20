// Rafael
$(document).ready(function () {

    var socket = io.connect("http://localhost:3000", { transports: ['websocket'] });
    socket.on('recargarUsuario', function(variable) {
        
    cargarUsuarios();



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
                    
                    if(index==0){
                        $("#jugador1").html(respuesta[index]["nombre"]);


                    }else if(index==1){
                        $("#jugador2").html(respuesta[index]["nombre"]);

                    }else if(index==2){
                        $("#jugador3").html(respuesta[index]["nombre"]);

                    }else if(index==3){
                        $("#jugador4").html(respuesta[index]["nombre"]);

                    }
                    
                }


















            }



        })

        







    }





})


