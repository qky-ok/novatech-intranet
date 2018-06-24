@extends('layouts.app')

@section('title', 'Editar Factura ' . $billing->title)

@section('content')

    <div class="row">
        <div class="col-md-5">
            <h3>Editar {{ $billing->title }}</h3>
        </div>
        <div class="col-md-7 page-action text-right">
            <a href="{{ route('billings.index') }}" class="btn btn-default btn-sm"> <i class="fa fa-arrow-left"></i> Volver</a>
        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-content">
                        {!! Form::model($billing, ['method' => 'POST', 'route' => ['billings.update'], 'class' => 'client-form']) !!}
                            {!! Form::hidden('id', $billing->id) !!}
                            {!! Form::hidden('id_user', $billing->id_user) !!}

                            <div class="form-group @if ($errors->has('id_state')) has-error @endif">
                                {!! Form::label('id_state', 'Estado') !!}
                                <select class="form-control" name="id_state">
                                    <option value="1" @if($billing->id_state == 1) selected="selected" @endif>Enviada</option>
                                    <option value="2" @if($billing->id_state == 2) selected="selected" @endif>En proceso</option>
                                    <option value="3" @if($billing->id_state == 3) selected="selected" @endif>Pagada</option>
                                </select>

                                @if ($errors->has('id_state')) <p class="help-block">{{ $errors->first('id_state') }}</p> @endif
                            </div>

                            @include('billing._form')

                            <div class="form-group">
                                @foreach($service_interventions as $billing_service_intervention)
                                    {!! Form::label('service_intervention', $billing_service_intervention->title) !!}
                                    <input class="form-control" type="text" style="margin:0 0 10px;" value="{{ $billing_service_intervention->amount }}" readonly/>
                                @endforeach

                                <label>TOTAL</label>
                                <input class="form-control" type="text" style="font-size:30px; font-weight:bold;" value="{{ $billing_service_intervention_total }}" readonly/>
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