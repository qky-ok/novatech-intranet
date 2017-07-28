@extends('layouts.app')

@section('title', 'Services')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h3 class="modal-title home">Services</h3>
            <div class="form-group service-search-form">
                {!! Form::text('service_search', null, ['class' => 'form-control', 'placeholder' => 'Service title']) !!}
                {!! Form::submit('Buscar', ['class' => 'btn btn-primary search-service']) !!}
            </div>
        </div>
    </div>

    <div class="result-set">
        <table class="table table-bordered table-striped table-hover" id="index-data-table">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>State</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
@endsection