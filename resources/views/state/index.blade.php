@extends('layouts.app')

@section('title', 'Estados')

@section('content')
    <div class="row">
        <div class="col-md-5">
            <h3 class="modal-title">{{ $result->total() }} {{ str_plural('Estado', $result->count()) }} </h3>
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

        <div class="text-center">
            {{ $result->links() }}
        </div>
    </div>

@endsection