jQuery(document).ready(function() {     
    $.extend( true, $.fn.DataTable.TableTools.classes, {
        "container": "btn-group DTTT_container",
        "buttons": {
            "normal": "btn btn-primary",
            "disabled": "btn disabled"
        },
        "collection": {
            "container": "DTTT_dropdown dropdown-menu",
            "buttons": {
                "normal": "",
                "disabled": "disabled"
            }
        }
    } );

    $('.datatable').dataTable({
        // Para no ordenar los indices de la filas
        "fnDrawCallback": function ( oSettings ) {
            /* Need to redo the counters if filtered or sorted */
            var that = this;

            if ( oSettings.bSorted || oSettings.bFiltered )
            {
                this.$('td:first-child', {"filter":"applied"}).each( function (i) {
                    that.fnUpdate( i+1, this.parentNode, 0, false, false );
                } );
            }
        },
        "aoColumnDefs": [
            { "bSortable": false, "aTargets": [ 0 ] }
        ],
        // Cambiar Palabras tablas
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
        "sDom": 'CT<"clear">lfrtip',
        //Aparecer o desaparecer columnas
        "colVis": {
            "buttonText": "Mostrar / Ocultar columnas"
        },
        //Exportar
        "oTableTools": {
            "sSwfPath": "/swf/copy_csv_xls_pdf.swf",
            "aButtons": [
                {   
                    'sTitle': $('.TituloExport').val(),
                    "sExtends":    "xls",
                    "sButtonText": '<i class="icon-th-list icon-white"></i> Excel ',
                    "sPdfOrientation": "landscape",
                    "mColumns": "visible"
                },
                {
                    'sTitle': $('.TituloExport').val(),
                    "sExtends":    "pdf",
                    "sButtonText": '<i class="icon-download-alt icon-white"></i> PDF ',
                    "sPdfOrientation": "landscape",
                    "mColumns": "visible"
                }
            ],

        },
    });

    $('.ColVis_MasterButton').addClass('btn btn-primary');
    $('.ColVis_MasterButton').css('width', '200px');
    $('.ColVis_MasterButton').removeClass('ColVis_Button');

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
