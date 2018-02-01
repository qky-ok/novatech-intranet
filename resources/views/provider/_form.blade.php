<!-- Part Model -->
<div class="form-group @if ($errors->has('provider')) has-error @endif">
    {!! Form::label('provider', 'Proveedor') !!}
    {!! Form::text('provider', (isset($provider->provider)) ? $provider->provider : null, ['class' => 'form-control', 'placeholder' => 'Proveedor']) !!}
    @if ($errors->has('provider')) <p class="help-block">{{ $errors->first('provider') }}</p> @endif
</div>