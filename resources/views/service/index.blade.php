@extends('layouts.app')

@section('title', 'Services')

@section('content')
    <div class="row">
        <div class="col-md-5">
            <h3 class="modal-title">{{ $result->total() }} {{ str_plural('Service', $result->count()) }} </h3>
        </div>
        <div class="col-md-7 page-action text-right">
            @can('add_services')
                <a href="{{ route('services.create') }}" class="btn btn-primary btn-sm"> <i class="glyphicon glyphicon-plus-sign"></i> Crear</a>
            @endcan
        </div>
    </div>

    <div class="result-set services">
        <table class="table table-bordered table-striped table-hover" id="services-data-table">
            <thead>
            <tr>
                <th>N° Ord. compra</th>
                <th>Estado</th>
                <th>CAS</th>
                <th>Fecha entrada</th>
                <th>Fecha compromiso</th>
                <th>Fecha salida</th>
                <th>Historial</th>
                <th>Creado</th>
                @can('edit_services', 'delete_services')
                    <th>Acciones</th>
                @endcan
            </tr>
            </thead>
            <tbody>
            @foreach($result as $item)
                <tr>
                    <td>{{ $item->purchase_order_num }}</td>
                    <td>{{ $item->state()->name }}</td>
                    <td>{{ $item->cas()->name }}</td>
                    <td>{{ $item->dateInToString(true) }}</td>
                    <td>{{ $item->dateCommitmentToString(true) }}</td>
                    <td>{{ $item->dateOutToString(true) }}</td>
                    <td class="text-center">
                        {!! Form::open( ['method' => 'post', 'url' => route('services.history'), 'style' => 'display: inline']) !!}
                            {!! Form::text('id', $item->id, ['class' => 'hidden']) !!}
                            <button type="submit" class="btn-delete btn btn-xs btn-info">
                                <i class="glyphicon glyphicon-list"></i>
                            </button>
                        {!! Form::close() !!}
                    </td>
                    <td>{{ $item->created_at->format('d/m/Y H:i:s') }}</td>
                    @can('edit_services', 'delete_services')
                    <td class="text-center">
                        @include('shared._actions', [
                            'entity' => 'services',
                            'id' => $item->id
                        ])
                    </td>
                    @endcan
                </tr>
            @endforeach
            </tbody>
        </table>

        <div class="text-center">
            {{ $result->links() }}
        </div>
    </div>
@endsection