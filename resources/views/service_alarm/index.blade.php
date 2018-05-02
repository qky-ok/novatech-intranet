@extends('layouts.app')

@section('title', 'Alarmas de Tickets')

@section('content')
    <div class="row">
        <div class="col-md-5">
            <h3 class="modal-title">{{ count($result) }} Alarmas </h3>
        </div>
    </div>

    <div class="result-set">
        <table class="table table-bordered table-striped table-hover" id="data-table">
            <thead>
            <tr>
                <th>Alarma</th>
                <th>Días</th>
                <th>Usuarios</th>
                <th>Acciones</th>
            </tr>
            </thead>
            <tbody>
                @foreach($result as $item)
                    <tr>
                        <td>{{ $item->alarm_name }}</td>
                        <td>{{ $item->alarm_days }}</td>
                        <td>
                            @if(!empty($item->roles()))
                                @foreach($item->roles() as $role)
                                    - {{ $role->name }}<br/>
                                @endforeach
                            @endif
                        </td>
                        <td class="text-center">
                            {!! Form::open( ['method' => 'get', 'url' => route('service_alarm.edit'), 'style' => 'display: inline']) !!}
                            {!! Form::text('id', $item->id, ['class' => 'hidden']) !!}
                            <button type="submit" class="btn-delete btn btn-xs btn-warning">
                                <i class="glyphicon glyphicon-edit"></i>
                            </button>
                            {!! Form::close() !!}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
