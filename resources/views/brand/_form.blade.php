<!-- Brand -->
<div class="form-group @if ($errors->has('brand')) has-error @endif">
    {!! Form::label('brand', 'Marca') !!}
    {!! Form::text('brand', (isset($brand->brand)) ? $brand->brand : null, ['class' => 'form-control', 'placeholder' => 'Marca']) !!}
    @if ($errors->has('brand')) <p class="help-block">{{ $errors->first('brand') }}</p> @endif
</div>