@extends('layouts.app')

@section('title', 'Garantía')

@section('content')
    <div class="row">
        <div class="col-md-5">
            <h3 class="modal-title">{{ $result->total() }} {{ str_plural('Garantía', $result->count()) }} </h3>
        </div>
        <div class="col-md-7 page-action text-right">
            <a href="{{ route('warranties.create') }}" class="btn btn-primary btn-sm"> <i class="glyphicon glyphicon-plus-sign"></i> Crear</a>
        </div>
    </div>

    <div class="result-set">
        <table class="table table-bordered table-striped table-hover" id="data-table">
            <thead>
            <tr>
                <th>Id</th>
                <th>N° Garantía</th>
                <th>N° Factura compra</th>
                <th>Fecha compra</th>
                <th class="text-center">Acciones</th>
            </tr>
            </thead>
            <tbody>
            @foreach($result as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->num_warranty }}</td>
                    <td>{{ $item->num_purchase_bill }}</td>
                    <td>{{ $item->datePurchaseToString(true) }}</td>
                    <td class="text-center">
                        @include('shared._actions', [
                            'entity'    => 'warranties',
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
                            title           : 'Novatech - Clientes',
                            exportOptions   : {
                                columns: [ 0, 1, 2, 3 ]
                            }
                        },
                        {
                            extend          : 'excelHtml5',
                            title           : 'Novatech - Clientes',
                            exportOptions   : {
                                columns: [ 0, 1, 2, 3 ]
                            }
                        },
                        {
                            extend          : 'print',
                            title           : 'Novatech - Clientes',
                            exportOptions   : {
                                columns: [ 0, 1, 2, 3 ]
                            }
                        }
                    ]
                });
            });
        </script>
    @endpush
@endsection