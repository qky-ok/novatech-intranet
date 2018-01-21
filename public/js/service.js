$(document).ready(function(){
    $('#services-data-table').DataTable({
        responsive  : true,
        order       : [5, 'desc'],
        dom         : 'Bfrtip',
        buttons     : [
            {
                extend          : 'copyHtml5',
                title           : 'Novatech - Services',
                exportOptions   : {
                    columns: [ 0, 1, 2, 3, 5 ]
                }
            },
            {
                extend          : 'excelHtml5',
                title           : 'Novatech - Services',
                exportOptions   : {
                    columns: [ 0, 1, 2, 3, 5 ]
                }
            },
            {
                extend          : 'print',
                title           : 'Novatech - Services',
                exportOptions   : {
                    columns: [ 0, 1, 2, 3, 5 ]
                }
            }
        ]
    });
});