<!-- Part Model -->
<div class="form-group @if ($errors->has('part_model')) has-error @endif">
    {!! Form::label('part_model', 'Modelo') !!}
    {!! Form::text('part_model', (isset($part_model->part_model)) ? $part_model->part_model : null, ['class' => 'form-control', 'placeholder' => 'Modelo']) !!}
    @if ($errors->has('part_model')) <p class="help-block">{{ $errors->first('part_model') }}</p> @endif
</div>

<!-- Brands Form Input -->
<div class="form-group @if ($errors->has('id_brand')) has-error @endif">
    {!! Form::label('id_brand', 'Marca') !!}
    <select class="form-control" name="id_brand">
        <option value="0">Seleccione una Marca</option>
        @foreach($brands as $brand)
            <option value="{{ $brand->id }}" @if(isset($service->id_brand) && $service->id_brand == $brand->id) selected="selected" @endif>{{ $brand->brand }}</option>
        @endforeach
    </select>

    @if ($errors->has('id_brand')) <p class="help-block">{{ $errors->first('id_brand') }}</p> @endif
</div>