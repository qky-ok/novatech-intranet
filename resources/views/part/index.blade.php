@extends('layouts.app')

@section('title', 'Parte')

@section('content')
    <div class="row">
        <div class="col-md-5">
            <h3 class="modal-title">{{ $result->count() }} {{ str_plural('Parte', $result->count()) }} </h3>
        </div>
        <div class="col-md-7 page-action text-right">
            <a href="{{ route('parts.create') }}" class="btn btn-primary btn-sm"> <i class="glyphicon glyphicon-plus-sign"></i> Crear</a>
        </div>
    </div>

    <div class="result-set">
        <table class="table table-bordered table-striped table-hover" id="data-table">
            <thead>
            <tr>
                <th>N° Parte</th>
                <th>Rubro</th>
                <th>Marca</th>
                <th>Modelos</th>
                <th>Familia</th>
                <th>Sub Familia</th>
                <th>Stock Depósito</th>
                <th class="text-center">Acciones</th>
            </tr>
            </thead>
            <tbody>
            @foreach($result as $item)
                <tr>
                    <td>{{ $item->num_part }}</td>
                    <td>@if(!empty($item->application_item())) {{ $item->application_item()->application_item }} @else - @endif</td>
                    <td>@if(!empty($item->brand())) {{ $item->brand()->brand }} @else - @endif</td>
                    <td>
                        @if(!empty($item->models()))
                            @foreach($item->models() as $model)
                                @if(!empty($model->model()))
                                    - {{ $model->model()->part_model }}<br/>
                                @else
                                    -<br/>
                                @endif
                            @endforeach
                        @else
                            -
                        @endif
                    </td>
                    <td>@if(!empty($item->family())) {{ $item->family()->family }} @else - @endif</td>
                    <td>@if(!empty($item->sub_family())) {{ $item->sub_family()->family }} @else - @endif</td>
                    <td>{{ $item->deposit_stock }}</td>
                    <td class="text-center">
                        @include('shared._actions', [
                            'entity'    => 'parts',
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
                    order       : [1, 'desc'],
                    dom         : 'Bfrtip',
                    buttons     : [
                        {
                            extend          : 'copyHtml5',
                            title           : 'Novatech - Parte',
                            exportOptions   : {
                                columns: [ 0, 1, 2, 3, 4, 5, 6 ]
                            }
                        },
                        {
                            extend          : 'excelHtml5',
                            title           : 'Novatech - Parte',
                            exportOptions   : {
                                columns: [ 0, 1, 2, 3, 4, 5, 6 ]
                            }
                        },
                        {
                            extend          : 'print',
                            title           : 'Novatech - Parte',
                            exportOptions   : {
                                columns: [ 0, 1, 2, 3, 4, 5, 6 ]
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