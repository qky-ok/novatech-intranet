<!-- InsuranceCompany -->
<div class="form-group @if ($errors->has('insurance_company')) has-error @endif">
    {!! Form::label('insurance_company', 'Compañía Aseguradora') !!}
    {!! Form::text('insurance_company', (isset($insurance_company->insurance_company)) ? $insurance_company->insurance_company : null, ['class' => 'form-control', 'placeholder' => 'Compañía Aseguradora']) !!}
    @if ($errors->has('insurance_company')) <p class="help-block">{{ $errors->first('insurance_company') }}</p> @endif
</div>