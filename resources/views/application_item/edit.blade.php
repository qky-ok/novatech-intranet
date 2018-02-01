@extends('layouts.app')

@section('title', 'Editar Aplicación / Rubro ' . $application_item->application_item)

@section('content')

    <div class="row">
        <div class="col-md-5">
            <h3>Editar {{ $application_item->application_item }}</h3>
        </div>
        <div class="col-md-7 page-action text-right">
            <a href="{{ route('application_items.index') }}" class="btn btn-default btn-sm"> <i class="fa fa-arrow-left"></i> Volver</a>
        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-content">
                        {!! Form::model($application_item, ['method' => 'POST', 'route' => ['application_items.update'], 'class' => 'client-form']) !!}
                            {!! Form::hidden('id', $application_item->id) !!}

                            @include('application_item._form')
                            <!-- Submit Form Button -->
                            {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection