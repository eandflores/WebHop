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
});
