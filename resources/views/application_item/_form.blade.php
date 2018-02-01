<!-- Aplicación / Rubro -->
<div class="form-group @if ($errors->has('application_item')) has-error @endif">
    {!! Form::label('application_item', 'Aplicación / Rubro') !!}
    {!! Form::text('application_item', (isset($application_item->application_item)) ? $application_item->application_item : null, ['class' => 'form-control', 'placeholder' => 'Aplicación / Rubro']) !!}
    @if ($errors->has('application_item')) <p class="help-block">{{ $errors->first('application_item') }}</p> @endif
</div>