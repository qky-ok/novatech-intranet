@extends('layouts.app')

@section('title', 'Editar Tipo de Garantía ' . $warranty_type->warranty_type)

@section('content')

    <div class="row">
        <div class="col-md-5">
            <h3>Editar {{ $warranty_type->warranty_type }}</h3>
        </div>
        <div class="col-md-7 page-action text-right">
            <a href="{{ route('warranty_types.index') }}" class="btn btn-default btn-sm"> <i class="fa fa-arrow-left"></i> Volver</a>
        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-content">
                        {!! Form::model($warranty_type, ['method' => 'POST', 'route' => ['warranty_types.update'], 'class' => 'client-form']) !!}
                            {!! Form::hidden('id', $warranty_type->id) !!}

                            @include('warranty_type._form')
                            <!-- Submit Form Button -->
                            {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection