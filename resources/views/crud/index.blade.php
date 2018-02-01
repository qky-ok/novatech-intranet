@extends('layouts.app')

@section('title', 'Altas')

@section('content')
    <div class="crud-menu test">
        <a href="{{ url('clients') }}" class="btn btn-primary btn-sm">Clientes</a>
        <a href="{{ url('parts') }}" class="btn btn-primary btn-sm">Partes</a>
        <a href="{{ url('part_models') }}" class="btn btn-primary btn-sm">Modelos</a>
        <a href="{{ url('brands') }}" class="btn btn-primary btn-sm">Marcas</a>
        <a href="{{ url('warranties') }}" class="btn btn-primary btn-sm">Garantías</a>
        <a href="{{ url('warranty_types') }}" class="btn btn-primary btn-sm">Tipo de Garantías</a>
        <a href="{{ url('application_items') }}" class="btn btn-primary btn-sm">Aplicaciones / Rubros</a>
        <a href="{{ url('families') }}" class="btn btn-primary btn-sm">Familias</a>
        <a href="{{ url('categories') }}" class="btn btn-primary btn-sm">Categorías</a>
        <a href="{{ url('selling_houses') }}" class="btn btn-primary btn-sm">Casas Vendedoras</a>
        <a href="{{ url('insurance_companies') }}" class="btn btn-primary btn-sm">Compañías Aseguradoras</a>
        <a href="{{ url('providers') }}" class="btn btn-primary btn-sm">Proveedores</a>
    </div>
@endsection