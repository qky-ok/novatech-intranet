@extends('layouts.app')

@section('title', 'Parte ' . $part->description)

@section('content')

    <div class="row">
        <div class="col-md-5">
            <h3>Parte: {{ $part->description }}</h3>
        </div>
        <div class="col-md-7 page-action text-right">
            <a href="{{ route('parts.index') }}" class="btn btn-default btn-sm"> <i class="fa fa-arrow-left"></i> Volver</a>
        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-content">
                        <div class="form-group">
                            {!! Form::label('id_application_item', 'Aplicación / Rubro') !!}

                            <span class="show-field">{{ (!empty($part->application_item()->application_item)) ? $part->application_item()->application_item : '-' }}</span>
                        </div>

                        <div class="form-group">
                            {!! Form::label('brand', 'Marca') !!}

                            <span class="show-field">{{ (!empty($part->brand()->brand)) ? $part->brand()->brand : '-' }}</span>
                        </div>

                        <div class="form-group">
                            {!! Form::label('part_models', 'Modelos') !!}

                            @if(!empty($part->models()))
                                @foreach($models as $model)
                                    @foreach($part->models() as $part_model)
                                        @if($part_model->id_model === $model->id)
                                            <span class="show-field">{{ $model->part_model }}</span>
                                        @endif
                                    @endforeach
                                @endforeach
                            @else
                                <span class="show-field"> - </span>
                            @endif
                        </div>

                        <div class="form-group">
                            {!! Form::label('id_family', 'Familia') !!}

                            <span class="show-field">{{ (!empty($part->family()->family)) ? $part->family()->family : '-' }}</span>
                        </div>

                        <div class="form-group">
                            {!! Form::label('id_sub_family', 'Sub Familia') !!}

                            <span class="show-field">{{ (!empty($part->sub_family()->family)) ? $part->sub_family()->family : '-' }}</span>
                        </div>

                        <div class="form-group">
                            {!! Form::label('part_parts', 'Parte de reemplazo') !!}

                            @if(!empty($part->replacement_parts()))
                                @foreach($parts as $replacement_part)
                                    @foreach($part->replacement_parts() as $part_part)
                                        @if($part_part->id_replacement_part === $replacement_part->id)
                                            <span class="show-field">{{ $replacement_part->description }}</span>
                                        @endif
                                    @endforeach
                                @endforeach
                            @else
                                <span class="show-field"> - </span>
                            @endif
                        </div>

                        <div class="form-group">
                            {!! Form::label('id_provider', 'Proveedor') !!}

                            <span class="show-field">{{ (!empty($part->provider()->provider)) ? $part->provider()->provider : '-' }}</span>
                        </div>

                        <div class="form-group">
                            {!! Form::label('num_part', 'N° de Parte') !!}

                            <span class="show-field">{{ (!empty($part->num_part)) ? $part->num_part : '-' }}</span>
                        </div>

                        <div class="form-group">
                            {!! Form::label('description', 'Descripción') !!}

                            <span class="show-field">{{ (!empty($part->description)) ? $part->description : '-' }}</span>
                        </div>

                        <div class="form-group">
                            {!! Form::label('weight', 'Peso') !!}

                            <span class="show-field">{{ (!empty($part->weight)) ? $part->weight : '-' }}</span>
                        </div>

                        <div class="form-group">
                            {!! Form::label('warranty_months', 'Meses de Garantía') !!}

                            <span class="show-field">{{ (!empty($part->warranty_months)) ? $part->warranty_months : '-' }}</span>
                        </div>

                        <div class="form-group">
                            {!! Form::label('discontinuous', 'Discontinuo') !!}

                            <span class="show-field">{{ ($part->discontinuous === 1) ? 'Si' : 'No' }}</span>
                        </div>

                        <div class="form-group">
                            {!! Form::label('scrap', 'Scrap') !!}

                            <span class="show-field">{{ ($part->scrap === 1) ? 'Si' : 'No' }}</span>
                        </div>

                        <div class="form-group">
                            {!! Form::label('images', 'Imágenes') !!}

                            @if(!empty($part->images()))
                                <div class="images-container">
                                    @foreach($part->images() as $image)
                                        <a class="img-btn-gallery" rel="parts" title="{{ $image->file_name }}" href="/part_images/{{ $image->file_name }}">
                                            <div class="img-container">
                                                <div class="img">
                                                    <img class="img-btn" src="/part_images/{{ $image->file_name }}">
                                                </div>
                                            </div>
                                        </a>
                                    @endforeach
                                </div>
                            @else
                                <span class="show-field"> - </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection