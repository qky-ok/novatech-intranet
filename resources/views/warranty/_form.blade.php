<!-- Warranty Types -->
<div class="form-group @if ($errors->has('id_warranty_type')) has-error @endif">
    {!! Form::label('id_warranty_type', 'Tipo de Garantía') !!}
    <select class="form-control" name="id_warranty_type">
        <option value="0">Seleccione un Tipo de Garantía</option>
        @foreach($warranty_types as $warranty_type)
            <option value="{{ $warranty_type->id }}" @if(isset($warranty->id_warranty_type) && $warranty->id_warranty_type == $warranty_type->id) selected="selected" @endif>{{ $warranty_type->warranty_type }}</option>
        @endforeach
    </select>

    @if ($errors->has('id_warranty_type')) <p class="help-block">{{ $errors->first('id_warranty_type') }}</p> @endif
</div>

<!-- Insurance Companies -->
<div class="form-group @if ($errors->has('id_insurance_company')) has-error @endif">
    {!! Form::label('id_insurance_company', 'Tipo de Garantía') !!}
    <select class="form-control" name="id_insurance_company">
        <option value="0">Seleccione una Compañía de Seguros</option>
        @foreach($insurance_companies as $insurance_company)
            <option value="{{ $insurance_company->id }}" @if(isset($warranty->id_insurance_company) && $warranty->id_insurance_company == $insurance_company->id) selected="selected" @endif>{{ $insurance_company->insurance_company }}</option>
        @endforeach
    </select>

    @if ($errors->has('id_insurance_company')) <p class="help-block">{{ $errors->first('id_insurance_company') }}</p> @endif
</div>

<!-- Num Warranty -->
<div class="form-group @if ($errors->has('num_warranty')) has-error @endif">
    {!! Form::label('num_warranty', 'N° de garantía') !!}
    {!! Form::text('num_warranty', (isset($warranty->num_warranty)) ? $warranty->num_warranty : null, ['class' => 'form-control', 'placeholder' => 'N° de garantía']) !!}
    @if ($errors->has('num_warranty')) <p class="help-block">{{ $errors->first('num_warranty') }}</p> @endif
</div>

<!-- Num Purchase Bill -->
<div class="form-group @if ($errors->has('num_purchase_bill')) has-error @endif">
    {!! Form::label('num_purchase_bill', 'N° de factura de compra') !!}
    {!! Form::text('num_purchase_bill', (isset($warranty->num_purchase_bill)) ? $warranty->num_purchase_bill : null, ['class' => 'form-control', 'placeholder' => 'N° de factura de compra']) !!}
    @if ($errors->has('num_purchase_bill')) <p class="help-block">{{ $errors->first('num_purchase_bill') }}</p> @endif
</div>

<!-- Num Refund -->
<div class="form-group @if ($errors->has('num_refund')) has-error @endif">
    {!! Form::label('num_refund', 'N° de reembolso') !!}
    {!! Form::text('num_refund', (isset($warranty->num_refund)) ? $warranty->num_refund : null, ['class' => 'form-control', 'placeholder' => 'N° de reembolso']) !!}
    @if ($errors->has('num_refund')) <p class="help-block">{{ $errors->first('num_refund') }}</p> @endif
</div>

<!-- Num Authorization -->
<div class="form-group @if ($errors->has('num_authorization')) has-error @endif">
    {!! Form::label('num_authorization', 'N° de autorización') !!}
    {!! Form::text('num_authorization', (isset($warranty->num_authorization)) ? $warranty->num_authorization : null, ['class' => 'form-control', 'placeholder' => 'N° de autorización']) !!}
    @if ($errors->has('num_authorization')) <p class="help-block">{{ $errors->first('num_authorization') }}</p> @endif
</div>

<!-- Num IMEI -->
<div class="form-group @if ($errors->has('num_imei')) has-error @endif">
    {!! Form::label('num_imei', 'N° de IMEI') !!}
    {!! Form::text('num_imei', (isset($warranty->num_imei)) ? $warranty->num_imei : null, ['class' => 'form-control', 'placeholder' => 'N° de IMEI']) !!}
    @if ($errors->has('num_imei')) <p class="help-block">{{ $errors->first('num_imei') }}</p> @endif
</div>

<!-- Num Insurance -->
<div class="form-group @if ($errors->has('num_insurance')) has-error @endif">
    {!! Form::label('num_insurance', 'N° de seguro') !!}
    {!! Form::text('num_insurance', (isset($warranty->num_insurance)) ? $warranty->num_insurance : null, ['class' => 'form-control', 'placeholder' => 'N° de seguro']) !!}
    @if ($errors->has('num_insurance')) <p class="help-block">{{ $errors->first('num_insurance') }}</p> @endif
</div>

<!-- Precedence -->
<div class="form-group @if ($errors->has('precedence')) has-error @endif">
    {!! Form::label('precedence', 'Precedencia') !!}
    {!! Form::text('precedence', (isset($warranty->precedence)) ? $warranty->precedence : null, ['class' => 'form-control', 'placeholder' => 'Precedencia']) !!}
    @if ($errors->has('precedence')) <p class="help-block">{{ $errors->first('precedence') }}</p> @endif
</div>

<!-- Date Purchase -->
<div class="form-group @if ($errors->has('date_purchase')) has-error @endif">
    {!! Form::label('date_purchase', 'Fecha de compra') !!}

    <div class="input-group date" id='date_purchase'>
        <input type="text" name="date_purchase" class="form-control" @if(isset($warranty->date_purchase) && $warranty->date_purchase !== '1970-01-01 00:00:00') value="{{ $warranty->datePurchaseToString() }}" @endif />
        <span class="input-group-addon">
            <span class="glyphicon glyphicon-calendar"></span>
        </span>
    </div>
    @if ($errors->has('date_purchase')) <p class="help-block">{{ $errors->first('date_purchase') }}</p> @endif
</div>

<!-- Date Failure -->
<div class="form-group @if ($errors->has('date_failure')) has-error @endif">
    {!! Form::label('date_failure', 'Fecha de falla') !!}

    <div class="input-group date" id='date_failure'>
        <input type="text" name="date_failure" class="form-control" @if(isset($warranty->date_failure) && $warranty->date_failure !== '1970-01-01 00:00:00') value="{{ $warranty->dateFailureToString() }}" @endif />
        <span class="input-group-addon">
            <span class="glyphicon glyphicon-calendar"></span>
        </span>
    </div>
    @if ($errors->has('date_failure')) <p class="help-block">{{ $errors->first('date_failure') }}</p> @endif
</div>

<!-- Date Fabrication -->
<div class="form-group @if ($errors->has('date_fabrication')) has-error @endif">
    {!! Form::label('date_fabrication', 'Fecha de fabricación') !!}

    <div class="input-group date" id='date_fabrication'>
        <input type="text" name="date_fabrication" class="form-control" @if(isset($warranty->date_fabrication) && $warranty->date_fabrication !== '1970-01-01 00:00:00') value="{{ $warranty->dateFabricationToString() }}" @endif />
        <span class="input-group-addon">
            <span class="glyphicon glyphicon-calendar"></span>
        </span>
    </div>
    @if ($errors->has('date_fabrication')) <p class="help-block">{{ $errors->first('date_fabrication') }}</p> @endif
</div>

<!-- Date Insurance Expiration -->
<div class="form-group @if ($errors->has('date_insurance_expiration')) has-error @endif">
    {!! Form::label('date_insurance_expiration', 'Fecha de vencimiento de seguro') !!}

    <div class="input-group date" id='date_insurance_expiration'>
        <input type="text" name="date_insurance_expiration" class="form-control" @if(isset($warranty->date_insurance_expiration) && $warranty->date_insurance_expiration !== '1970-01-01 00:00:00') value="{{ $warranty->dateInsuranceExpirationToString() }}" @endif />
        <span class="input-group-addon">
            <span class="glyphicon glyphicon-calendar"></span>
        </span>
    </div>
    @if ($errors->has('date_purchase')) <p class="help-block">{{ $errors->first('date_purchase') }}</p> @endif
</div>

<!-- Warranty Extension -->
<div class="form-group @if ($errors->has('warranty_extension')) has-error @endif">
    {!! Form::label('warranty_extension', 'Extensión de garantía') !!}
    {!! Form::checkbox('warranty_extension', 1, (isset($warranty->warranty_extension) && $warranty->warranty_extension === 1) ? true : false) !!}
    @if ($errors->has('warranty_extension')) <p class="help-block">{{ $errors->first('warranty_extension') }}</p> @endif
</div>

<!-- Exception -->
<div class="form-group @if ($errors->has('exception')) has-error @endif">
    {!! Form::label('exception', 'Excepción') !!}
    {!! Form::checkbox('exception', 1, (isset($warranty->exception) && $warranty->exception === 1) ? true : false) !!}
    @if ($errors->has('exception')) <p class="help-block">{{ $errors->first('exception') }}</p> @endif
</div>

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function(){
            var datePurchase            = $('#date_purchase');
            var dateFailure             = $('#date_failure');
            var dateFabrication         = $('#date_fabrication');
            var dateInsuranceExpiration = $('#date_insurance_expiration');

            datePurchase.datetimepicker({
                locale: 'es',
                showClose: true,
                format: 'DD-MM-YYYY'
            });
            datePurchase.find('input').click(function(){
                $(this).next().click();
            });

            dateFailure.datetimepicker({
                locale: 'es',
                showClose: true,
                format: 'DD-MM-YYYY'
            });
            dateFailure.find('input').click(function(){
                $(this).next().click();
            });

            dateFabrication.datetimepicker({
                locale: 'es',
                showClose: true,
                format: 'DD-MM-YYYY'
            });
            dateFabrication.find('input').click(function(){
                $(this).next().click();
            });

            dateInsuranceExpiration.datetimepicker({
                locale: 'es',
                showClose: true,
                format: 'DD-MM-YYYY'
            });
            dateInsuranceExpiration.find('input').click(function(){
                $(this).next().click();
            });
        });
    </script>
@endpush