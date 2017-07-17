@extends('layouts.app')

@section('title', 'Services')

@section('content')
    <div class="row">
        <div class="col-md-5">
            <h3 class="modal-title">Service: <b>{{ $service->title }}</b> history</h3>
        </div>
        <div class="col-md-7 page-action text-right">
            <a href="{{ route('services.index') }}" class="btn btn-default btn-sm"> <i class="fa fa-arrow-left"></i> Back</a>
        </div>
    </div>

    <div class="result-set">
        <table class="table table-bordered table-striped table-hover" id="data-table">
            <tbody>
            @foreach($history as $incidence)
                <tr>
                    @if($incidence->id_state != null && $incidence->edited_fields != null)
                        <td><b>{{ $incidence->created_at->format('d/m/Y H:i:s') }}:</b> User <b>{{ $incidence->cas()->name }}</b> changed the Service's State to <b>{{ $incidence->state()->name }}</b> and edited the following fields: <b>{{ $incidence->formattedEditedFields() }}</b></td>
                    @elseif($incidence->id_state != null && $incidence->edited_fields == null)
                        <td><b>{{ $incidence->created_at->format('d/m/Y H:i:s') }}:</b> User <b>{{ $incidence->cas()->name }}</b> changed the Service's State to <b>{{ $incidence->state()->name }}</b></td>
                    @else
                        <td><b>{{ $incidence->created_at->format('d/m/Y H:i:s') }}:</b> User <b>{{ $incidence->cas()->name }}</b> edited the following fields: <b>{{ $incidence->formattedEditedFields() }}</b></td>
                    @endif
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

@endsection