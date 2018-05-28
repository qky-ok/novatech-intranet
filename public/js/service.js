$(document).ready(function(){
    var dataTableElem       = $('#services-data-table');
    var dateInElem          = $('#date_in');
    var dateOutElem         = $('#date_out');
    var dateCommitmentElem  = $('#date_commitment');

    if(dataTableElem.length){
        dataTableElem.DataTable({
            responsive  : true,
            order       : [0, 'desc'],
            dom         : 'Bfrtip',
            buttons     : [
                {
                    extend          : 'copyHtml5',
                    title           : 'Novatech - Services',
                    exportOptions   : {
                        columns: [ 0, 1, 2, 3, 4, 5, 6, 7 ]
                    }
                },
                {
                    extend          : 'excelHtml5',
                    title           : 'Novatech - Services',
                    exportOptions   : {
                        columns: [ 0, 1, 2, 3, 4, 5, 6, 7 ]
                    }
                },
                {
                    extend          : 'print',
                    title           : 'Novatech - Services',
                    exportOptions   : {
                        columns: [ 0, 1, 2, 3, 4, 5, 6, 7 ]
                    }
                }
            ],
            language:{
                "sProcessing":     "Procesando...",
                "sLengthMenu":     "Mostrar _MENU_ registros",
                "sZeroRecords":    "No se encontraron resultados",
                "sEmptyTable":     "Ningún dato disponible en esta tabla",
                "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
                "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                "sInfoPostFix":    "",
                "sSearch":         "Buscar:",
                "sUrl":            "",
                "sInfoThousands":  ",",
                "sLoadingRecords": "Cargando...",
                "oPaginate": {
                    "sFirst":    "Primero",
                    "sLast":     "Último",
                    "sNext":     "Siguiente",
                    "sPrevious": "Anterior"
                },
                "oAria": {
                    "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                    "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                }
            }
        });
    }

    if(dateInElem && dateOutElem && dateCommitmentElem.length){
        dateInElem.datetimepicker({
            locale: 'es',
            showClose: true,
            format: 'DD-MM-YYYY'
        });
        dateInElem.find('input').click(function(){
            $(this).next().click();
        });

        dateOutElem.datetimepicker({
            locale: 'es',
            showClose: true,
            format: 'DD-MM-YYYY'
        });
        dateOutElem.find('input').click(function(){
            $(this).next().click();
        });

        dateCommitmentElem.datetimepicker({
            locale: 'es',
            showClose: true,
            format: 'DD-MM-YYYY'
        });
        dateCommitmentElem.find('input').click(function(){
            $(this).next().click();
        });
    }
});