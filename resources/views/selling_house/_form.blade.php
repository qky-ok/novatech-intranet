<!-- Business Name -->
<div class="form-group @if ($errors->has('business_name')) has-error @endif">
    {!! Form::label('business_name', 'Razón Social') !!}
    {!! Form::text('business_name', (isset($selling_house->business_name)) ? $selling_house->business_name : null, ['class' => 'form-control', 'placeholder' => 'Razón Social']) !!}
    @if ($errors->has('business_name')) <p class="help-block">{{ $errors->first('business_name') }}</p> @endif
</div>

<!-- Address -->
<div class="form-group address @if($errors->has('address') || $errors->has('contact') || $errors->has('email') || $errors->has('phone')) has-error @endif">
    {!! Form::label('address', 'Dirección') !!}
    {!! Form::text('address', (isset($selling_house->address))  ? $selling_house->address   : null, ['class' => 'form-control', 'placeholder' => 'Dirección']) !!}
    {!! Form::text('contact', (isset($selling_house->contact))  ? $selling_house->contact   : null, ['class' => 'form-control', 'placeholder' => 'Contacto']) !!}
    {!! Form::text('phone', (isset($selling_house->phone))      ? $selling_house->phone     : null, ['class' => 'form-control', 'placeholder' => 'Teléfono']) !!}
    {!! Form::text('email', (isset($selling_house->email))      ? $selling_house->email     : null, ['class' => 'form-control', 'placeholder' => 'Email']) !!}
    @if ($errors->has('address')) <p class="help-block">{{ $errors->first('address') }}</p> @endif
    @if ($errors->has('contact')) <p class="help-block">{{ $errors->first('contact') }}</p> @endif
    @if ($errors->has('phone')) <p class="help-block">{{ $errors->first('phone') }}</p> @endif
    @if ($errors->has('email')) <p class="help-block">{{ $errors->first('email') }}</p> @endif
</div>