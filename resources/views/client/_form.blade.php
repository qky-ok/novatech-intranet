<!-- Date Created -->
<div class="form-group @if ($errors->has('date_created')) has-error @endif">
    {!! Form::label('date_created', 'Fecha de alta') !!}

    <div class="input-group date" id='date_created'>
        <input type="text" name="date_created" class="form-control" @if(isset($client->date_created) && $client->date_created !== '1970-01-01 00:00:00') value="{{ $client->dateToString() }}" @endif />
        <span class="input-group-addon">
            <span class="glyphicon glyphicon-calendar"></span>
        </span>
    </div>
    @if ($errors->has('date_created')) <p class="help-block">{{ $errors->first('date_created') }}</p> @endif
</div>

<!-- Price List ID -->
<div class="form-group @if ($errors->has('id_price_list')) has-error @endif">
    {!! Form::label('id_price_list', 'ID lista de precios') !!}
    {!! Form::text('id_price_list', (isset($client->id_price_list)) ? $client->id_price_list : null, ['class' => 'form-control', 'placeholder' => 'ID lista de precios']) !!}
    @if ($errors->has('id_price_list')) <p class="help-block">{{ $errors->first('id_price_list') }}</p> @endif
</div>

<!-- Business Name -->
<div class="form-group @if ($errors->has('business_name')) has-error @endif">
    {!! Form::label('business_name', 'Razón Social') !!}
    {!! Form::text('business_name', (isset($client->business_name)) ? $client->business_name : null, ['class' => 'form-control', 'placeholder' => 'Razón Social']) !!}
    @if ($errors->has('business_name')) <p class="help-block">{{ $errors->first('business_name') }}</p> @endif
</div>

<!-- Company Name -->
<div class="form-group @if ($errors->has('company')) has-error @endif">
    {!! Form::label('company', 'Compañía') !!}
    {!! Form::text('company', (isset($client->company)) ? $client->company : null, ['class' => 'form-control', 'placeholder' => 'Compañía']) !!}
    @if ($errors->has('company')) <p class="help-block">{{ $errors->first('company') }}</p> @endif
</div>

<!-- Sex -->
<div class="form-group @if ($errors->has('business_name')) has-error @endif">
    {{ Form::label('sex', 'Sexo', array('class' => 'sex-label')) }}
    {{ Form::label('sex-m', 'Masculino') }}
    {{ Form::radio('sex', 'm', (!isset($client->sex)) ? true : (isset($client->sex) && $client->sex !== 'm') ? true : false, array('id' => 'sex-m')) }}
    {{ Form::label('sex-f', 'Femenino', array('class' => 'sex-label-f')) }}
    {{ Form::radio('sex', 'f', (isset($client->sex) && $client->sex === 'f') ? true : false, array('id' => 'sex-f')) }}
    @if ($errors->has('sex')) <p class="help-block">{{ $errors->first('sex') }}</p> @endif
</div>

<!-- Address -->
<div class="form-group address @if($errors->has('address') || $errors->has('province') || $errors->has('postal_code') || $errors->has('locality')) has-error @endif">
    {!! Form::label('address', 'Dirección') !!}
    {!! Form::text('address', (isset($client->address))         ? $client->address      : null, ['class' => 'form-control', 'placeholder' => 'Dirección']) !!}
    {!! Form::text('province', (isset($client->province))       ? $client->province     : null, ['class' => 'form-control', 'placeholder' => 'Provincia']) !!}
    {!! Form::text('locality', (isset($client->locality))       ? $client->locality     : null, ['class' => 'form-control', 'placeholder' => 'Localidad']) !!}
    {!! Form::text('postal_code', (isset($client->postal_code)) ? $client->postal_code  : null, ['class' => 'form-control', 'placeholder' => 'Código Postal']) !!}
    @if ($errors->has('address')) <p class="help-block">{{ $errors->first('address') }}</p> @endif
    @if ($errors->has('province')) <p class="help-block">{{ $errors->first('province') }}</p> @endif
    @if ($errors->has('locality')) <p class="help-block">{{ $errors->first('locality') }}</p> @endif
    @if ($errors->has('postal_code')) <p class="help-block">{{ $errors->first('postal_code') }}</p> @endif
</div>

<!-- CUIT -->
<div class="form-group @if ($errors->has('cuit')) has-error @endif">
    {!! Form::label('cuit', 'CUIT') !!}
    {!! Form::text('cuit', (isset($client->cuit)) ? $client->cuit : null, ['class' => 'form-control', 'placeholder' => 'CUIT']) !!}
    @if ($errors->has('cuit')) <p class="help-block">{{ $errors->first('cuit') }}</p> @endif
</div>

<!-- Doc type -->
<div class="form-group @if ($errors->has('doc_type')) has-error @endif">
    {!! Form::label('business_name', 'Tipo de Documento') !!}
    <select class="form-control" name="doc_type">
        <option value="0" @if(isset($client->doc_type) && $client->doc_type == 0) selected="selected" @endif>DNI</option>
        <option value="1" @if(isset($client->doc_type) && $client->doc_type == 1) selected="selected" @endif>CI</option>
    </select>
    @if ($errors->has('business_name')) <p class="help-block">{{ $errors->first('business_name') }}</p> @endif
</div>

<!-- Doc -->
<div class="form-group @if ($errors->has('doc')) has-error @endif">
    {!! Form::label('doc', 'Documento') !!}
    {!! Form::text('doc', (isset($client->doc)) ? $client->doc : null, ['class' => 'form-control', 'placeholder' => 'Documento']) !!}
    @if ($errors->has('doc')) <p class="help-block">{{ $errors->first('doc') }}</p> @endif
</div>

<!-- IVA relation -->
<div class="form-group @if ($errors->has('iva_relation')) has-error @endif">
    {!! Form::label('iva_relation', 'Relación IVA') !!}
    {!! Form::text('iva_relation', (isset($client->iva_relation)) ? $client->iva_relation : null, ['class' => 'form-control', 'placeholder' => 'Relación IVA']) !!}
    @if ($errors->has('iva_relation')) <p class="help-block">{{ $errors->first('iva_relation') }}</p> @endif
</div>

<!-- Phone Home -->
<div class="form-group @if ($errors->has('phone_home')) has-error @endif">
    {!! Form::label('phone_home', 'Teléfono particular') !!}
    {!! Form::text('phone_home', (isset($client->phone_home)) ? $client->phone_home : null, ['class' => 'form-control', 'placeholder' => 'Teléfono particular']) !!}
    @if ($errors->has('phone_home')) <p class="help-block">{{ $errors->first('phone_home') }}</p> @endif
</div>

<!-- Phone Work -->
<div class="form-group @if ($errors->has('phone_work')) has-error @endif">
    {!! Form::label('phone_work', 'Teléfono trabajo') !!}
    {!! Form::text('phone_work', (isset($client->phone_work)) ? $client->phone_work : null, ['class' => 'form-control', 'placeholder' => 'Teléfono trabajo']) !!}
    @if ($errors->has('phone_work')) <p class="help-block">{{ $errors->first('phone_work') }}</p> @endif
</div>

<!-- Phone Mobile -->
<div class="form-group @if ($errors->has('phone_mobile')) has-error @endif">
    {!! Form::label('phone_mobile', 'Teléfono móvil') !!}
    {!! Form::text('phone_mobile', (isset($client->phone_mobile)) ? $client->phone_mobile : null, ['class' => 'form-control', 'placeholder' => 'Teléfono móvil']) !!}
    @if ($errors->has('phone_mobile')) <p class="help-block">{{ $errors->first('phone_mobile') }}</p> @endif
</div>

<!-- Fax -->
<div class="form-group @if ($errors->has('business_name')) has-error @endif">
    {!! Form::label('fax', 'Fax') !!}
    {!! Form::text('fax', (isset($client->fax)) ? $client->fax : null, ['class' => 'form-control', 'placeholder' => 'Fax']) !!}
    @if ($errors->has('fax')) <p class="help-block">{{ $errors->first('fax') }}</p> @endif
</div>

<!-- Skype -->
<div class="form-group @if ($errors->has('skype')) has-error @endif">
    {!! Form::label('skype', 'Skype') !!}
    {!! Form::text('skype', (isset($client->skype)) ? $client->skype : null, ['class' => 'form-control', 'placeholder' => 'Skype']) !!}
    @if ($errors->has('skype')) <p class="help-block">{{ $errors->first('skype') }}</p> @endif
</div>

<!-- Email -->
<div class="form-group @if ($errors->has('email')) has-error @endif">
    {!! Form::label('email', 'Email') !!}
    {!! Form::text('email', (isset($client->email)) ? $client->email : null, ['class' => 'form-control', 'placeholder' => 'Email']) !!}
    @if ($errors->has('email')) <p class="help-block">{{ $errors->first('email') }}</p> @endif
</div>

<!-- Website -->
<div class="form-group @if ($errors->has('website')) has-error @endif">
    {!! Form::label('website', 'Sitio web') !!}
    {!! Form::text('website', (isset($client->website)) ? $client->website : null, ['class' => 'form-control', 'placeholder' => 'Sitio web']) !!}
    @if ($errors->has('website')) <p class="help-block">{{ $errors->first('website') }}</p> @endif
</div>

<!-- Blacklist -->
<div class="form-group @if ($errors->has('blacklist')) has-error @endif">
    {!! Form::label('blacklist', 'Poner en lista negra') !!}
    {!! Form::checkbox('blacklist', 1, (isset($client->blacklist) && $client->blacklist === 1) ? true : false) !!}
    @if ($errors->has('blacklist')) <p class="help-block">{{ $errors->first('blacklist') }}</p> @endif
</div>

<!-- Send services amount -->
<div class="form-group @if ($errors->has('send_services_amount')) has-error @endif">
    {!! Form::label('send_services_amount', 'Enviar los importes de los servicios al cliente') !!}
    {!! Form::checkbox('send_services_amount', 1, (isset($client->send_services_amount) && $client->send_services_amount === 1) ? true : false) !!}
    @if ($errors->has('send_services_amount')) <p class="help-block">{{ $errors->first('send_services_amount') }}</p> @endif
</div>

<!-- States Input -->
<div class="form-group @if ($errors->has('client_services_states')) has-error @endif">
    {!! Form::label('client_services_states', 'Roles') !!}
    <select multiple="multiple" class="form-control" name="client_services_states[]">
        <option value="0">Seleccione Estados para alertar al Cliente (ctrl + click)</option>
        @foreach($states as $state)
            @php $selected = false @endphp
            @if(isset($state) && !empty($client_services_states))
                @foreach($client_services_states as $client_service_state)
                    {{ ($client_service_state->id === $state->id) ? $selected = true : '' }}
                @endforeach
            @endif

            <option value="{{ $state->id }}" @if($selected) selected="selected" @endif>{{ $state->name }}</option>
        @endforeach
    </select>

    @if ($errors->has('client_services_states')) <p class="help-block">{{ $errors->first('client_services_states') }}</p> @endif
</div>

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function(){
            var dateCreated = $('#date_created');

            dateCreated.datetimepicker({
                locale: 'es',
                showClose: true,
                format: 'DD-MM-YYYY'
            });
            dateCreated.find('input').click(function(){
                $(this).next().click();
            });
        });
    </script>
@endpush