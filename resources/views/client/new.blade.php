@extends('layouts.app')

@section('title', 'Crear Cliente')

@section('content')
    <div class="row">
        <div class="col-md-5">
            <h3>Crear</h3>
        </div>
        <div class="col-md-7 page-action text-right">
            <a href="{{ route('clients.index') }}" class="btn btn-default btn-sm"> <i class="fa fa-arrow-left"></i> Volver</a>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            {!! Form::open(['route' => ['clients.store'], 'class' => 'client-form']) !!}
                @include('client._form')
                <!-- Submit Form Button -->
                {!! Form::submit('Crear', ['class' => 'btn btn-primary']) !!}
            {!! Form::close() !!}
        </div>
    </div>
@endsection