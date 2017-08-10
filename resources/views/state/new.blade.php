@extends('layouts.app')

@section('title', 'Crear Estado')

@section('content')

    <div class="row">
        <div class="col-md-5">
            <h3>Crear</h3>
        </div>
        <div class="col-md-7 page-action text-right">
            <a href="{{ route('states.index') }}" class="btn btn-default btn-sm"> <i class="fa fa-arrow-left"></i> Volver</a>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            {!! Form::open(['route' => ['states.store'] ]) !!}
                @include('state._form')
                <!-- Submit Form Button -->
                {!! Form::submit('Crear', ['class' => 'btn btn-primary']) !!}
            {!! Form::close() !!}
        </div>
    </div>
@endsection