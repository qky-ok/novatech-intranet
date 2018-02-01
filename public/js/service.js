$(document).ready(function(){
    var dataTableElem       = $('#services-data-table');
    var dateInElem          = $('#date_in');
    var dateOutElem         = $('#date_out');
    var dateCommitmentElem  = $('#date_commitment');

    if(dataTableElem.length){
        dataTableElem.DataTable({
            responsive  : true,
            order       : [5, 'desc'],
            dom         : 'Bfrtip',
            buttons     : [
                {
                    extend          : 'copyHtml5',
                    title           : 'Novatech - Services',
                    exportOptions   : {
                        columns: [ 0, 1, 2, 3, 4, 5 ]
                    }
                },
                {
                    extend          : 'excelHtml5',
                    title           : 'Novatech - Services',
                    exportOptions   : {
                        columns: [ 0, 1, 2, 3, 4, 5 ]
                    }
                },
                {
                    extend          : 'print',
                    title           : 'Novatech - Services',
                    exportOptions   : {
                        columns: [ 0, 1, 2, 3, 4, 5 ]
                    }
                }
            ]
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