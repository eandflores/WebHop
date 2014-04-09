jQuery(document).ready(function() {     
    $('.datatable').dataTable({
        "oLanguage": {
                "sLengthMenu": "_MENU_ elementos",
                "sSearch": "Buscar:",
                "sZeroRecords": "No hay elementos que mostrar",
                "sInfo": "Mostrando _START_ de _END_ de _TOTAL_ elementos", 
                /*Paginador titulos*/
                "oPaginate": {
                    "sNext": "Siguiente",
                    "sPrevious": "Anterior",
                }
            },
    });

    $('#flashMessage').append('<button type="button" class="close" data-dismiss="alert">&times;</button>');

    $('.usa-tooltip').tooltip();

    // function alerta(){
    //     //un alert
    //     alertify.alert("<b>Blog Reaccion Estudio</b> probando Alertify", function () {
    //         //aqui introducimos lo que haremos tras cerrar la alerta.
    //         //por ejemplo -->  location.href = 'http://www.google.es/';  <-- Redireccionamos a GOOGLE.
    //     });
    // }
    // function confirmar(){
    //       //un confirm
    //       alertify.confirm("<p>Aquí confirmamos algo.<br><br><b>ENTER</b> y <b>ESC</b> corresponden a <b>Aceptar</b> o <b>Cancelar</b></p>", function (e) {
    //             if (e) {
    //                   alertify.success("Has pulsado '" + alertify.labels.ok + "'");
    //             } else { 
    //                         alertify.error("Has pulsado '" + alertify.labels.cancel + "'");
    //             }
    //       }); 
    //       return false
    // }
                       
    // function datos(){
    //       //un prompt
    //       alertify.prompt("Esto es un <b>prompt</b>, introduce un valor:", function (e, str) { 
    //             if (e){
    //                   alertify.success("Has pulsado '" + alertify.labels.ok + "'' e introducido: " + str);
    //             }else{
    //                   alertify.error("Has pulsado '" + alertify.labels.cancel + "'");
    //             }
    //       });
    //       return false;
    // }
                       
    // function notificacion(){
    //         //una notificación normal
    //       alertify.log("Esto es una notificación cualquiera."); 
    //       return false;
    // }
                       
    // function ok(){
    //         //una notificación correcta
    //       alertify.success("Visita nuestro <a href=\"http://blog.reaccionestudio.com/\" style=\"color:white;\" target=\"_blank\"><b>BLOG.</b></a>"); 
    //       return false;
    // }
                       
    // function error(){
    //         //una notificación de error
    //       alertify.error("Usuario o constraseña incorrecto/a."); 
    //       return false; 
    // }
});
