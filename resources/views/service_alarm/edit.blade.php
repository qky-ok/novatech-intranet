@extends('layouts.app')

@section('title', 'Editar Alarma ' . $service_alarm->alarm_name)

@section('content')

    <div class="row">
        <div class="col-md-5">
            <h3>Editar {{ $service_alarm->alarm_name }}</h3>
        </div>
        <div class="col-md-7 page-action text-right">
            <a href="{{ route('service_alarm.index') }}" class="btn btn-default btn-sm"> <i class="fa fa-arrow-left"></i> Volver</a>
        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-content">
                        {!! Form::model($service_alarm, ['method' => 'POST', 'route' => ['service_alarm.update'] ]) !!}
                            {!! Form::hidden('id', $service_alarm->id) !!}

                            <!-- Alarm Days Input -->
                            <div class="form-group @if ($errors->has('alarm_days')) has-error @endif">
                                {!! Form::label('alarm_days', 'Días') !!}
                                {!! Form::text('alarm_days', (!empty($service_alarm->alarm_days)) ? $service_alarm->alarm_days : null, ['class' => 'form-control', 'placeholder' => 'Días']) !!}
                                @if ($errors->has('alarm_days')) <p class="help-block">{{ $errors->first('alarm_days') }}</p> @endif
                            </div>

                            <!-- Roles Input -->
                            <div class="form-group @if ($errors->has('alarm_users')) has-error @endif">
                                {!! Form::label('alarm_users', 'Roles') !!}
                                <select multiple="multiple" class="form-control" name="alarm_users[]">
                                    <option value="0">Seleccione Modelos (ctrl + click)</option>
                                    @foreach($roles as $role)
                                        @php $selected = false @endphp
                                        @if(isset($role) && !empty($alarm_roles))
                                            @foreach($alarm_roles as $alarm_role)
                                                {{ ($alarm_role->id === $role->id) ? $selected = true : '' }}
                                            @endforeach
                                        @endif

                                        <option value="{{ $role->id }}" @if($selected) selected="selected" @endif>{{ $role->name }}</option>
                                    @endforeach
                                </select>

                                @if ($errors->has('alarm_users')) <p class="help-block">{{ $errors->first('alarm_users') }}</p> @endif
                            </div>

                            <!-- Submit Form Button -->
                            {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection