@extends('layouts.app')

@section('title', 'Facturación')

@section('content')
    <div class="row">
        <div class="col-md-5">
            <h3>Crear factura</h3>
        </div>
        <div class="col-md-7 page-action text-right">
            <a href="{{ route('billings.index') }}" class="btn btn-default btn-sm"> <i class="fa fa-arrow-left"></i> Volver</a>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            {!! Form::open(['route' => ['billings.store'], 'class' => 'client-form']) !!}
                {!! Form::hidden('id_user', $id_user) !!}
                {!! Form::hidden('id_state', 1) !!}
                {!! Form::hidden('service_ids_str', $service_ids_str) !!}


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
                {!! Form::submit('Crear', ['class' => 'btn btn-primary']) !!}
            {!! Form::close() !!}
        </div>
    </div>
@endsection