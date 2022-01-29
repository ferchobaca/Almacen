$(buscarDatos ());
function buscarDatos(consulta){
    $.ajax({
        url: '/DataWarehouse.php',
        type: 'POST',
        dataType: 'html',
        data: {consulta: consulta},
    })
        .done(function(respuesta){
            $("#datos").html(respuesta);
        })
        .fail(function (){
            console.log("error");
        })
}