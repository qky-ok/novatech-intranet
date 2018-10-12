@extends('layouts.app')

@section('title', 'Tickets')

@section('content')
    <div class="row">
        <div class="col-md-5">
            <h3 class="modal-title">Listar Tickets</h3>
        </div>
        <div class="col-md-7 page-action text-right">
            @can('add_services')
                <a href="{{ route('services.create') }}" class="btn btn-primary btn-sm"> <i class="glyphicon glyphicon-plus-sign"></i> Crear</a>
            @endcan
        </div>
    </div>

    <div class="result-set services" style="width: 200px;">
        {!! Form::open(['method' => 'POST', 'route' => ['services.list'], 'class' => 'service-form']) !!}
            <div class="form-group">
                {!! Form::label('service_list_type', 'Seleccione una lista') !!}
                <select class="form-control" name="service_list_type">
                    <option value="0">Listar todo</option>
                    <option value="1">Estado Ingresado</option>
                    <option value="2">Estado Derivado</option>
                    <option value="3">Estado Esperando repuestos</option>
                    <option value="4">Estado En reparación</option>
                    <option value="5">Estado Entregado</option>
                    <option value="6">Estado A Presupuestar</option>
                    <option value="98">Alerta Amarilla</option>
                    <option value="99">Alerta Naranja</option>
                    <option value="100">Alerta Roja</option>
                </select>
            </div>
            {!! Form::submit('Listar', ['class' => 'btn btn-primary']) !!}
        {!! Form::close() !!}
    </div>

    <div class="result-set services" style="width: 200px;">
        {!! Form::open(['method' => 'POST', 'route' => ['services.list_by_id'], 'class' => 'service-form']) !!}
        <div class="form-group">
            {!! Form::label('service_id', 'Introduzca un ID de Ticket') !!}
            <input type="text" class="form-control" name="service_id" />
        </div>
        {!! Form::submit('Listar x ID', ['class' => 'btn btn-primary']) !!}
        {!! Form::close() !!}
    </div>
@endsection