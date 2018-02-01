@extends('layouts.app')

@section('title', 'Editar Casa Vendedora ' . $selling_house->business_name)

@section('content')

    <div class="row">
        <div class="col-md-5">
            <h3>Editar {{ $selling_house->business_name }}</h3>
        </div>
        <div class="col-md-7 page-action text-right">
            <a href="{{ route('selling_houses.index') }}" class="btn btn-default btn-sm"> <i class="fa fa-arrow-left"></i> Volver</a>
        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-content">
                        {!! Form::model($selling_house, ['method' => 'POST', 'route' => ['selling_houses.update'], 'class' => 'client-form']) !!}
                            {!! Form::hidden('id', $selling_house->id) !!}

                            @include('selling_house._form')
                            <!-- Submit Form Button -->
                            {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection