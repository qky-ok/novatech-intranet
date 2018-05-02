@extends('layouts.app')

@section('title', 'Tickets')

@section('content')
    <div class="row">
        <div class="col-md-5">
            <h3 class="modal-title">{{ $result->total() }} {{ str_plural('Ticket', $result->count()) }} </h3>
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
                <th>ID</th>
                <th>N° de Ticket</th>
                <th>Estado</th>
                <th>CAS</th>
                <th>Cliente</th>
                <th>Fechas</th>
                <th>Datos Cliente</th>
                <th>Alarma</th>
                <th>Historial</th>
                <th>Creado</th>
                @can('edit_services', 'delete_services')
                    <th>Acciones</th>
                @endcan
            </tr>
            </thead>
            <tbody>
            @foreach($result as $item)
                @php
                    $alert_style = "";
                    if(isset($item->alarmCheck()->name)){
                        switch($item->alarmCheck()->name){
                            case 'Alerta Amarilla':
                                $alert_style = "background-color: #ffff6e;";
                            break;
                            case 'Alerta Naranja':
                                $alert_style = "background-color: #ffcc70;";
                            break;
                            case 'Alerta Roja':
                                $alert_style = "background-color: #ff9696;";
                            break;
                        }
                    }
                @endphp

                <tr style="{{ $alert_style }}">
                    <td>{{ $item->id }}</td>
                    <td>{{ (!empty($item->ticket_number)) ? $item->ticket_number : ' - ' }}</td>
                    <td>{{ (!empty($item->state()->name)) ? $item->state()->name : ' - ' }}</td>
                    <td>{{ (!empty($item->cas()->name)) ? $item->cas()->name : ' - ' }}</td>
                    <td>{{ (!empty($item->client()->business_name)) ? $item->client()->business_name : ' - ' }}</td>
                    <td>
                        <b>Entrada</b>:
                        <br/>{{ $item->dateInToString(true) }}<br/>
                        <b>Compromiso</b>:
                        <br/>{{ $item->dateCommitmentToString(true) }}<br/>
                        <b>Salida</b>:
                        <br/>{{ $item->dateOutToString(true) }}
                    </td>
                    <td>
                        @if($item->id_client > 0)
                            <b>Dirección</b>:
                            <br/>{{ $item->client()->address }}<br/>
                            <b>Teléfono</b>:
                            <br/>{{ $item->client()->phone_work }}
                        @endif
                    </td>
                    <td>
                        @if(isset($item->alarmCheck()->name))
                            {{ $item->alarmCheck()->name.' (faltan '.$item->alarmCheck()->days.' días)' }}
                        @endif
                    </td>
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