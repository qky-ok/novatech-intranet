@extends('layouts.app')

@section('title', 'Familia')

@section('content')
    <div class="row">
        <div class="col-md-5">
            <h3>Crear</h3>
        </div>
        <div class="col-md-7 page-action text-right">
            <a href="{{ route('families.index') }}" class="btn btn-default btn-sm"> <i class="fa fa-arrow-left"></i> Volver</a>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            {!! Form::open(['route' => ['families.store'], 'class' => 'client-form']) !!}
                @include('family._form')
                <!-- Submit Form Button -->
                {!! Form::submit('Crear', ['class' => 'btn btn-primary']) !!}
            {!! Form::close() !!}
        </div>
    </div>
@endsection