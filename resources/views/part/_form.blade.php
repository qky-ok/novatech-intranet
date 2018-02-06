<!-- Application Item -->
<div class="form-group @if ($errors->has('id_application_item')) has-error @endif">
    {!! Form::label('id_application_item', 'Aplicación / Rubro') !!}
    <select class="form-control" name="id_application_item">
        <option value="0">Seleccione una Aplicación / Rubro</option>
        @foreach($application_items as $application_item)
            <option value="{{ $application_item->id }}" @if(isset($part->id_application_item) && $part->id_application_item == $application_item->id) selected="selected" @endif>{{ $application_item->application_item }}</option>
        @endforeach
    </select>

    @if ($errors->has('id_application_item')) <p class="help-block">{{ $errors->first('id_application_item') }}</p> @endif
</div>

<!-- Brands -->
<div class="form-group @if ($errors->has('id_brand')) has-error @endif">
    {!! Form::label('id_brand', 'Marca') !!}
    <select class="form-control" name="id_brand">
        <option value="0">Seleccione una Marca</option>
        @foreach($brands as $brand)
            <option value="{{ $brand->id }}" @if(isset($part->id_brand) && $part->id_brand == $brand->id) selected="selected" @endif>{{ $brand->brand }}</option>
        @endforeach
    </select>

    @if ($errors->has('id_brand')) <p class="help-block">{{ $errors->first('id_brand') }}</p> @endif
</div>

<!-- Models -->
<div class="form-group @if ($errors->has('id_model')) has-error @endif">
    {!! Form::label('id_model', 'Modelo') !!}
    <select class="form-control" name="id_model">
        <option value="0">Seleccione un Modelo</option>
        @foreach($models as $model)
            <option value="{{ $model->id }}" @if(isset($part->id_model) && $part->id_model == $model->id) selected="selected" @endif>{{ $model->part_model }}</option>
        @endforeach
    </select>

    @if ($errors->has('id_model')) <p class="help-block">{{ $errors->first('id_model') }}</p> @endif
</div>

<!-- Family -->
<div class="form-group @if ($errors->has('id_family')) has-error @endif">
    {!! Form::label('id_family', 'Familia') !!}
    <select class="form-control" name="id_family">
        <option value="0">Seleccione una Familia</option>
        @foreach($families as $family)
            <option value="{{ $family->id }}" @if(isset($part->id_family) && $part->id_family == $family->id) selected="selected" @endif>{{ $family->family }}</option>
        @endforeach
    </select>

    @if ($errors->has('id_family')) <p class="help-block">{{ $errors->first('id_family') }}</p> @endif
</div>

<!-- Sub Family -->
<div class="form-group @if ($errors->has('id_sub_family')) has-error @endif">
    {!! Form::label('id_sub_family', 'Sub Familia') !!}
    <select class="form-control" name="id_sub_family">
        <option value="0">Seleccione una Sub Familia</option>
        @foreach($families as $family)
            <option value="{{ $family->id }}" @if(isset($part->id_sub_family) && $part->id_sub_family == $family->id) selected="selected" @endif>{{ $family->family }}</option>
        @endforeach
    </select>

    @if ($errors->has('id_sub_family')) <p class="help-block">{{ $errors->first('id_sub_family') }}</p> @endif
</div>

<!-- Replacement Part -->
<div class="form-group @if ($errors->has('id_replacement_part')) has-error @endif">
    {!! Form::label('id_replacement_part', 'Parte de reemplazo') !!}
    <select class="form-control" name="id_replacement_part">
        <option value="0">Seleccione una Parte de reemplazo</option>
        @foreach($parts as $replacement_part)
            <option value="{{ $replacement_part->id }}" @if(isset($part->id_replacement_part) && $part->id_replacement_part == $replacement_part->id) selected="selected" @endif>{{ $replacement_part->description }}</option>
        @endforeach
    </select>

    @if ($errors->has('id_replacement_part')) <p class="help-block">{{ $errors->first('id_replacement_part') }}</p> @endif
</div>

<!-- Provider -->
<div class="form-group @if ($errors->has('id_provider')) has-error @endif">
    {!! Form::label('id_provider', 'Proveedor') !!}
    <select class="form-control" name="id_provider">
        <option value="0">Seleccione un Proveedor</option>
        @foreach($providers as $provider)
            <option value="{{ $provider->id }}" @if(isset($part->id_provider) && $part->id_provider == $provider->id) selected="selected" @endif>{{ $provider->provider }}</option>
        @endforeach
    </select>

    @if ($errors->has('id_provider')) <p class="help-block">{{ $errors->first('id_provider') }}</p> @endif
</div>

<!-- Num Part -->
<div class="form-group @if ($errors->has('num_part')) has-error @endif">
    {!! Form::label('num_part', 'N° de Parte') !!}
    {!! Form::text('num_part', (isset($part->num_part)) ? $part->num_part : null, ['class' => 'form-control', 'placeholder' => 'N° de Parte']) !!}
    @if ($errors->has('num_part')) <p class="help-block">{{ $errors->first('num_part') }}</p> @endif
</div>

<!-- Description -->
<div class="form-group @if ($errors->has('description')) has-error @endif">
    {!! Form::label('description', 'Descripción') !!}
    {!! Form::text('description', (isset($part->description)) ? $part->description : null, ['class' => 'form-control', 'placeholder' => 'Descripción']) !!}
    @if ($errors->has('description')) <p class="help-block">{{ $errors->first('description') }}</p> @endif
</div>

<!-- Weight -->
<div class="form-group @if ($errors->has('weight')) has-error @endif">
    {!! Form::label('weight', 'Peso') !!}
    {!! Form::text('weight', (isset($part->weight)) ? $part->weight : null, ['class' => 'form-control', 'placeholder' => 'Peso']) !!}
    @if ($errors->has('weight')) <p class="help-block">{{ $errors->first('weight') }}</p> @endif
</div>

<!-- Warranty Months -->
<div class="form-group @if ($errors->has('warranty_months')) has-error @endif">
    {!! Form::label('warranty_months', 'Meses de Garantía') !!}
    {!! Form::text('warranty_months', (isset($part->warranty_months)) ? $part->warranty_months : null, ['class' => 'form-control', 'placeholder' => 'Meses de Garantía']) !!}
    @if ($errors->has('warranty_months')) <p class="help-block">{{ $errors->first('warranty_months') }}</p> @endif
</div>

<!-- Discontinuous -->
<div class="form-group @if ($errors->has('discontinuous')) has-error @endif">
    {!! Form::label('discontinuous', 'Discontinuo') !!}
    {!! Form::checkbox('discontinuous', 1, (isset($part->discontinuous) && $part->discontinuous === 1) ? true : false) !!}
    @if ($errors->has('discontinuous')) <p class="help-block">{{ $errors->first('discontinuous') }}</p> @endif
</div>

<!-- Scrap -->
<div class="form-group @if ($errors->has('scrap')) has-error @endif">
    {!! Form::label('scrap', 'Scrap') !!}
    {!! Form::checkbox('scrap', 1, (isset($part->scrap) && $part->scrap === 1) ? true : false) !!}
    @if ($errors->has('scrap')) <p class="help-block">{{ $errors->first('scrap') }}</p> @endif
</div>

@if(isset($part) && !$part->images()->isEmpty())
    <!-- Image Delete -->
    <div class="form-group images-container-group @if ($errors->has('image_delete')) has-error @endif">
        {!! Form::label('image_delete', 'Borrar Imágenes') !!}
        <div class="images-container">
            @foreach($part->images() as $image)
                <div class="img-container">
                    <span class="img-title">{{ $image->file_name }}</span>
                    <div class="img">
                        <img class="img-btn" src="/part_images/{{ $image->file_name }}">
                    </div>
                    <a id="remove_{{ $image->id }}" data-file-name="{{ $image->file_name }}" class="btn cms-btn-delete btn-small btn-danger img-delete part-image-delete">X</a>
                </div>
            @endforeach
        </div>
        @if ($errors->has('image_delete')) <p class="help-block">{{ $errors->first('image_delete') }}</p> @endif
    </div>
@endif

<!-- Image Upload -->
<div class="form-group image-upload-container @if ($errors->has('image_upload')) has-error @endif">
    {!! Form::label('image_upload', 'Subir Imágenes') !!}

    <div id="dropzone" class="dropzone dropzone-image-row">
        <div class="dz-message" data-dz-message>Arrastre o haga click para subir imagenes aquí</div>
    </div>

    @if ($errors->has('image_upload')) <p class="help-block">{{ $errors->first('image_upload') }}</p> @endif
</div>