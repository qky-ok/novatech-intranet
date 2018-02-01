@extends('layouts.app')

@section('title', 'Editar Modelo ' . $part_model->part_model)

@section('content')

    <div class="row">
        <div class="col-md-5">
            <h3>Editar {{ $part_model->part_model }}</h3>
        </div>
        <div class="col-md-7 page-action text-right">
            <a href="{{ route('part_models.index') }}" class="btn btn-default btn-sm"> <i class="fa fa-arrow-left"></i> Volver</a>
        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-content">
                        {!! Form::model($part_model, ['method' => 'POST', 'route' => ['part_models.update'], 'class' => 'client-form']) !!}
                            {!! Form::hidden('id', $part_model->id) !!}

                            @include('part_model._form')
                            <!-- Submit Form Button -->
                            {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection