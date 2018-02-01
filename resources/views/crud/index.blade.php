@extends('layouts.app')

@section('title', 'Altas')

@section('content')
    <div class="crud-menu test">
        <a href="{{ url('clients') }}" class="btn btn-primary btn-sm"> <i class="glyphicon glyphicon-plus-sign"></i> Crear Cliente</a>
        <a href="{{ url('parts') }}" class="btn btn-primary btn-sm"> <i class="glyphicon glyphicon-plus-sign"></i> Crear Parte</a>
        <a href="{{ url('part_models') }}" class="btn btn-primary btn-sm"> <i class="glyphicon glyphicon-plus-sign"></i> Crear Modelo</a>
        <a href="{{ url('brands') }}" class="btn btn-primary btn-sm"> <i class="glyphicon glyphicon-plus-sign"></i> Crear Marca</a>
        <a href="{{ url('warranties') }}" class="btn btn-primary btn-sm"> <i class="glyphicon glyphicon-plus-sign"></i> Crear Garantía</a>
        <a href="{{ url('warranty_types') }}" class="btn btn-primary btn-sm"> <i class="glyphicon glyphicon-plus-sign"></i> Crear Tipo de Garantía</a>
        <a href="{{ url('application_items') }}" class="btn btn-primary btn-sm"> <i class="glyphicon glyphicon-plus-sign"></i> Crear Aplicación / Rubro</a>
        <a href="{{ url('families') }}" class="btn btn-primary btn-sm"> <i class="glyphicon glyphicon-plus-sign"></i> Crear Familia</a>
        <a href="{{ url('categories') }}" class="btn btn-primary btn-sm"> <i class="glyphicon glyphicon-plus-sign"></i> Crear Categoría</a>
        <a href="{{ url('selling_houses') }}" class="btn btn-primary btn-sm"> <i class="glyphicon glyphicon-plus-sign"></i> Crear Casa Vendedora</a>
        <a href="{{ url('insurance_companies') }}" class="btn btn-primary btn-sm"> <i class="glyphicon glyphicon-plus-sign"></i> Crear Compañía Aseguradora</a>
        <a href="{{ url('providers') }}" class="btn btn-primary btn-sm"> <i class="glyphicon glyphicon-plus-sign"></i> Crear Proveedor</a>
    </div>
@endsection