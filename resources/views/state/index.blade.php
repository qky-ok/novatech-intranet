@extends('layouts.app')

@section('title', 'Estados')

@section('content')
    <div class="row">
        <div class="col-md-5">
            <h3 class="modal-title">{{ $result->count() }} {{ str_plural('Estado', $result->count()) }} </h3>
        </div>
        <div class="col-md-7 page-action text-right">
            @can('add_states')
            <a href="{{ route('states.create') }}" class="btn btn-primary btn-sm"> <i class="glyphicon glyphicon-plus-sign"></i> Crear</a>
            @endcan
        </div>
    </div>

    <div class="result-set">
        <table class="table table-bordered table-striped table-hover" id="data-table">
            <thead>
            <tr>
                <th>Id</th>
                <th>Nombre</th>
                <th>Creado</th>
                @can('edit_states', 'delete_states')
                <th class="text-center">Acciones</th>
                @endcan
            </tr>
            </thead>
            <tbody>
            @foreach($result as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->created_at->toFormattedDateString() }}</td>

                    @can('edit_states')
                    <td class="text-center">
                        @include('shared._actions', [
                            'entity' => 'states',
                            'id' => $item->id
                        ])
                    </td>
                    @endcan
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
                    order       : [1, 'desc'],
                    dom         : 'Bfrtip',
                    buttons     : [
                        {
                            extend          : 'copyHtml5',
                            title           : 'Novatech - Estados',
                            exportOptions   : {
                                columns: [ 0, 1, 2 ]
                            }
                        },
                        {
                            extend          : 'excelHtml5',
                            title           : 'Novatech - Estados',
                            exportOptions   : {
                                columns: [ 0, 1, 2 ]
                            }
                        },
                        {
                            extend          : 'print',
                            title           : 'Novatech - Estados',
                            exportOptions   : {
                                columns: [ 0, 1, 2 ]
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