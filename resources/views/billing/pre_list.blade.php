@extends('layouts.app')

@section('title', 'Facturación')

@section('content')
    <div class="row">
        <div class="col-md-5">
            <h3 class="modal-title">{{ $casServiceStock->count() }} @if($casServiceStock->count() === 1) Pre Facturación @else Pre Facturaciones @endif</h3>
        </div>
    </div>

    <div class="result-set">
        <table class="table table-bordered table-striped table-hover" id="data-table">
            <thead>
            <tr>
                <th>N° Ticket</th>
                <th>CAS</th>
                <th>Debe Administración</th>
                <th>Debe CAS</th>
                <th>Estado parte</th>
                <th class="text-center">Acciones</th>
            </tr>
            </thead>
            <tbody>
            @foreach($casServiceStock as $item)
                <tr>
                    <td>{{ $item->service()->ticket_number }}</td>
                    <td>
                        @foreach($cas_users as $cas_user)
                            @if($item->service()->id_user == $cas_user->id) {{ $cas_user->name }} @endif
                        @endforeach
                    </td>
                    <td @if($item->service()->cas_stock == 1 || $item->service()->cas_stock == 2 || $item->service()->cas_stock == 6) style="background-color:red" @endif>
                        @if($item->service()->cas_stock == 1 || $item->service()->cas_stock == 2 || $item->service()->cas_stock == 6) - @endif
                    </td>
                    <td @if($item->service()->cas_stock == 3) style="background-color:red" @endif>
                        @if($item->service()->cas_stock == 3) - @endif
                    </td>
                    <td>
                        @if($item->service()->cas_stock == 0) - @endif
                        @if($item->service()->cas_stock == 1) Pedido @endif
                        @if($item->service()->cas_stock == 2) En proceso de compra @endif
                        @if($item->service()->cas_stock == 3) Enviado @endif
                        @if($item->service()->cas_stock == 4) Devuelto @endif
                        @if($item->service()->cas_stock == 5) Recibido Conforme @endif
                        @if($item->service()->cas_stock == 6) Recibido NO Conforme @endif
                    </td>
                    <td class="text-center">
                        @include('shared._actions', [
                            'entity'    => 'billings',
                            'id'        => $item->id
                        ])
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    @push('scripts')
        <script type="text/javascript">
            $(document).ready(function(){
                $('#data-table').DataTable({
                    responsive  : true,
                    order       : [0, 'desc'],
                    dom         : 'Bfrtip',
                    buttons     : [
                        {
                            extend          : 'copyHtml5',
                            title           : 'Novatech - Pre Facturación',
                            exportOptions   : {
                                columns: [ 0, 1, 2, 3, 4 ]
                            }
                        },
                        {
                            extend          : 'excelHtml5',
                            title           : 'Novatech - Pre Facturación',
                            exportOptions   : {
                                columns: [ 0, 1, 2, 3, 4 ]
                            }
                        },
                        {
                            extend          : 'print',
                            title           : 'Novatech - Pre Facturación',
                            exportOptions   : {
                                columns: [ 0, 1, 2, 3, 4 ]
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
            });
        </script>
    @endpush
@endsection