<!-- Warranty Type -->
<div class="form-group @if ($errors->has('warranty_type')) has-error @endif">
    {!! Form::label('warranty_type', 'Tipo de Garantía') !!}
    {!! Form::text('warranty_type', (isset($warranty->warranty_type)) ? $warranty->warranty_type : null, ['class' => 'form-control', 'placeholder' => 'Tipo de Garantía']) !!}
    @if ($errors->has('warranty_type')) <p class="help-block">{{ $errors->first('warranty_type') }}</p> @endif
</div>