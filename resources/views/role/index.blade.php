@extends('layouts.app')

@section('title', 'Roles y Permisos')

@section('content')

    <!-- Modal -->
    <div class="modal fade" id="roleModal" tabindex="-1" role="dialog" aria-labelledby="roleModalLabel">
        <div class="modal-dialog" role="document">
            {!! Form::open(['method' => 'service']) !!}

            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="roleModalLabel">Rol</h4>
                </div>
                <div class="modal-body">
                    <!-- name Form Input -->
                    <div class="form-group @if ($errors->has('name')) has-error @endif">
                        {!! Form::label('name', 'Nombre') !!}
                        {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Nombre del Rol']) !!}
                        @if ($errors->has('name')) <p class="help-block">{{ $errors->first('name') }}</p> @endif
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>

                    <!-- Submit Form Button -->
                    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-5">
            <h3>Roles</h3>
        </div>
        <!--<div class="col-md-7 page-action text-right">
            @can('add_roles')
                <a href="#" class="btn btn-sm btn-success pull-right" data-toggle="modal" data-target="#roleModal"> <i class="glyphicon glyphicon-plus"></i> Nuevo</a>
            @endcan
        </div>-->
    </div>

    @forelse ($roles as $role)
        {!! Form::model($role, ['method' => 'POST', 'route' => ['roles.update'], 'class' => 'm-b']) !!}
            {!! Form::hidden('id', $role->id) !!}

            @if($role->name === 'Admin')
                @include('shared._permissions', [
                              'title'   => $role->name,
                              'options' => ['disabled'] ])
            @else
                @include('shared._permissions', [
                              'title' => $role->name,
                              'model' => $role ])
                @can('edit_roles')
                    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
                @endcan
            @endif

        {!! Form::close() !!}

    @empty
        <p></p>
    @endforelse
@endsection