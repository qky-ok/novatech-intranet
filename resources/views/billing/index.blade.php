@extends('layouts.app')

@section('title', 'Facturación')

@section('content')
    <div class="row">
        @if(!empty($servicesForBilling))
            <div class="col-md-5">
                <h3 class="modal-title">{{ count($servicesForBilling) }} @if(count($servicesForBilling) === 1) Servicio @else Servicios @endif a facturar</h3>
            </div>

            {!! Form::open(['route' => ['billings.create'], 'class' => 'client-form services-for-billing', 'method' => 'get']) !!}
                @foreach($servicesForBilling as $index => $serviceForBilling)
                    <div class="form-group">
                        {!! Form::label('service_ids['.$index.']', 'N° Ticket: '.$serviceForBilling->ticket_number) !!}
                        {!! Form::checkbox('service_ids['.$index.']', $serviceForBilling->id, false) !!}
                    </div>
                @endforeach
                {!! Form::submit('Facturar', ['class' => 'btn btn-primary']) !!}
            {!! Form::close() !!}
        @else
            @if(Auth::user()->roles->pluck('name')->first() != 'Admin')
                <div class="col-md-5">
                    <h3 class="modal-title">Sin servicios a facturar</h3>
                </div>
            @endif
        @endif
    </div>

    <div class="row">
        <div class="col-md-5">
            <h3 class="modal-title">{{ $billing->count() }} @if($billing->count() === 1) Facturación @else Facturaciones @endif</h3>
        </div>
    </div>

    <div class="result-set">
        <table class="table table-bordered table-striped table-hover" id="data-table">
            <thead>
            <tr>
                <th>N° Factura</th>
                <th>Fecha</th>
                <th>Total</th>
                <th>Estado</th>
                <th class="text-center">Acciones</th>
            </tr>
            </thead>
            <tbody>
            @foreach($billing as $item)
                <tr>
                    <td>{{ $item->bill_number }}</td>
                    <td>{{ $item->dateToString() }}</td>
                    <td>{{ '$'.$item->total() }}</td>
                    <td>{{ $item->state() }}</td>
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
                            title           : 'Novatech - Facturación',
                            exportOptions   : {
                                columns: [ 0, 1, 2 ]
                            }
                        },
                        {
                            extend          : 'excelHtml5',
                            title           : 'Novatech - Facturación',
                            exportOptions   : {
                                columns: [ 0, 1, 2 ]
                            }
                        },
                        {
                            extend          : 'print',
                            title           : 'Novatech - Facturación',
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