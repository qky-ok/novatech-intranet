@extends('layouts.app')

@section('title', 'Usuarios')

@section('content')
    <div class="row">
        <div class="col-md-4">
            <h3 class="modal-title">{{ $result->total() }} {{ str_plural('User', $result->count()) }} </h3>
        </div>
        <div class="col-md-8 page-action text-right">
            @can('add_users')
                @foreach($roles as $role)
                    <a href="{{ url('users/create', [$role->id]) }}" class="btn btn-primary btn-sm"> <i class="glyphicon glyphicon-plus-sign"></i> Crear {{ $role->name }}</a>
                @endforeach
            @endcan
        </div>
    </div>

    <div class="result-set">
        <table class="table table-bordered table-striped table-hover" id="data-table">
            <thead>
            <tr>
                <th>Id</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Rol</th>
                <th>Creado</th>
                @can('edit_users', 'delete_users')
                <th class="text-center">Acciones</th>
                @endcan
            </tr>
            </thead>
            <tbody>
            @foreach($result as $item)
               <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->email }}</td>
                    <td>{{ $item->roles->implode('name', ', ') }}</td>
                    <td>{{ $item->created_at->toFormattedDateString() }}</td>

                    @can('edit_users')
                    <td class="text-center">
                        @include('shared._actions', [
                            'entity' => 'users',
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