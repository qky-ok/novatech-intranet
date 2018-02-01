@extends('layouts.app')

@section('title', 'Editar Cliente ' . $client->company)

@section('content')

    <div class="row">
        <div class="col-md-5">
            <h3>Editar {{ $client->company }}</h3>
        </div>
        <div class="col-md-7 page-action text-right">
            <a href="{{ route('clients.index') }}" class="btn btn-default btn-sm"> <i class="fa fa-arrow-left"></i> Volver</a>
        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-content">
                        {!! Form::model($client, ['method' => 'POST', 'route' => ['clients.update'], 'class' => 'client-form']) !!}
                            {!! Form::hidden('id', $client->id) !!}

                            @include('client._form')
                            <!-- Submit Form Button -->
                            {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection