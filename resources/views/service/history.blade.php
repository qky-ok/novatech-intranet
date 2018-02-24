@extends('layouts.app')

@section('title', 'Tickets')

@section('content')
    <div class="row">
        <div class="col-md-5">
            <h3 class="modal-title">Historial del Ticket: <b>{{ $service->purchase_order_num }}</b></h3>
        </div>
        <div class="col-md-7 page-action text-right">
            <a href="{{ route('services.index') }}" class="btn btn-default btn-sm"> <i class="fa fa-arrow-left"></i> Volver</a>
        </div>
    </div>

    <div class="result-set">
        <table class="table table-bordered table-striped table-hover" id="data-table">
            <tbody>
            @foreach($history as $incidence)
                @if($incidence->id_state != null && $incidence->edited_fields != null)
                    @if($role->canViewState($incidence->id_state))
                        <tr><td><b>{{ $incidence->created_at->format('d/m/Y H:i:s') }}:</b> El usuario <b>{{ $incidence->cas()->name }}</b> cambió el Estado del Ticket a <b>{{ $incidence->state()->name }}</b> y editó los siguientes campos: <b>{{ $incidence->formattedEditedFields() }}</b></td></tr>
                    @endif
                @elseif($incidence->id_state != null && $incidence->edited_fields == null)
                    @if($role->canViewState($incidence->id_state))
                        <tr><td><b>{{ $incidence->created_at->format('d/m/Y H:i:s') }}:</b> El usuario <b>{{ $incidence->cas()->name }}</b> cambió el Estado del Ticket a <b>{{ $incidence->state()->name }}</b></td></tr>
                    @endif
                @else
                    <tr><td><b>{{ $incidence->created_at->format('d/m/Y H:i:s') }}:</b> El usuario <b>{{ $incidence->cas()->name }}</b> editó los siguientes campos: <b>{{ $incidence->formattedEditedFields() }}</b></td></tr>
                @endif
            @endforeach
            </tbody>
        </table>
    </div>

@endsection