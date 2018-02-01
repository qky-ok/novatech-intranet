@extends('layouts.app')

@section('title', 'Aplicación / Rubro')

@section('content')
    <div class="row">
        <div class="col-md-5">
            <h3 class="modal-title">{{ $result->total() }} {{ str_plural('Aplicación / Rubro', $result->count()) }} </h3>
        </div>
        <div class="col-md-7 page-action text-right">
            <a href="{{ route('application_items.create') }}" class="btn btn-primary btn-sm"> <i class="glyphicon glyphicon-plus-sign"></i> Crear</a>
        </div>
    </div>

    <div class="result-set">
        <table class="table table-bordered table-striped table-hover" id="data-table">
            <thead>
            <tr>
                <th>Id</th>
                <th>Aplicación / Rubro</th>
                <th class="text-center">Acciones</th>
            </tr>
            </thead>
            <tbody>
            @foreach($result as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->application_item }}</td>
                    <td class="text-center">
                        @include('shared._actions', [
                            'entity'    => 'application_items',
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
                            title           : 'Novatech - Aplicación / Rubro',
                            exportOptions   : {
                                columns: [ 0, 1 ]
                            }
                        },
                        {
                            extend          : 'excelHtml5',
                            title           : 'Novatech - Aplicación / Rubro',
                            exportOptions   : {
                                columns: [ 0, 1 ]
                            }
                        },
                        {
                            extend          : 'print',
                            title           : 'Novatech - Aplicación / Rubro',
                            exportOptions   : {
                                columns: [ 0, 1 ]
                            }
                        }
                    ]
                });
            });
        </script>
    @endpush
@endsection