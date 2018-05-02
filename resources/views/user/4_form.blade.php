<!-- Name Form Input -->
<div class="form-group @if ($errors->has('name')) has-error @endif">
    {!! Form::label('name', 'Nombre') !!}
    {!! Form::text('name', (!empty($user->name)) ? $user->name : null, ['class' => 'form-control', 'placeholder' => 'Nombre']) !!}
    @if ($errors->has('name')) <p class="help-block">{{ $errors->first('name') }}</p> @endif
</div>

<!-- email Form Input -->
<div class="form-group @if ($errors->has('email')) has-error @endif">
    {!! Form::label('email', 'Email') !!}
    {!! Form::text('email', (!empty($user->email)) ? $user->email : null, ['class' => 'form-control', 'placeholder' => 'Email']) !!}
    @if ($errors->has('email')) <p class="help-block">{{ $errors->first('email') }}</p> @endif
</div>

<!-- password Form Input -->
<div class="form-group @if ($errors->has('password')) has-error @endif">
    {!! Form::label('password', 'Password') !!}
    {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Password']) !!}
    @if ($errors->has('password')) <p class="help-block">{{ $errors->first('password') }}</p> @endif
</div>


<!-- Business Name -->
<div class="form-group @if ($errors->has('business_name')) has-error @endif">
    {!! Form::label('business_name', 'Razón Social') !!}
    {!! Form::text('business_name', (isset($extendedData->business_name)) ? $extendedData->business_name : null, ['class' => 'form-control', 'placeholder' => 'Razón Social']) !!}
    @if ($errors->has('business_name')) <p class="help-block">{{ $errors->first('business_name') }}</p> @endif
</div>
<!-- Fantasy Name -->
<div class="form-group @if ($errors->has('fantasy_name')) has-error @endif">
    {!! Form::label('fantasy_name', 'Nombre de Fantasía') !!}
    {!! Form::text('fantasy_name', (isset($extendedData->fantasy_name)) ? $extendedData->fantasy_name : null, ['class' => 'form-control', 'placeholder' => 'Nombre de Fantasía']) !!}
    @if ($errors->has('fantasy_name')) <p class="help-block">{{ $errors->first('fantasy_name') }}</p> @endif
</div>
<!-- Address -->
<div class="form-group @if ($errors->has('address')) has-error @endif">
    {!! Form::label('address', 'Dirección') !!}
    {!! Form::text('address', (isset($extendedData->address)) ? $extendedData->address : null, ['class' => 'form-control', 'placeholder' => 'Dirección']) !!}
    @if ($errors->has('address')) <p class="help-block">{{ $errors->first('address') }}</p> @endif
</div>
<!-- Phone Customers -->
<div class="form-group @if ($errors->has('phone_customers')) has-error @endif">
    {!! Form::label('phone_customers', 'Teléfono de atención al cliente') !!}
    {!! Form::text('phone_customers', (isset($extendedData->phone_customers)) ? $extendedData->phone_customers : null, ['class' => 'form-control', 'placeholder' => 'Teléfono de atención al cliente']) !!}
    @if ($errors->has('phone_customers')) <p class="help-block">{{ $errors->first('phone_customers') }}</p> @endif
</div>
<!-- Working Hours -->
<div class="form-group @if ($errors->has('working_hours')) has-error @endif">
    {!! Form::label('working_hours', 'Horarios') !!}
    {!! Form::text('working_hours', (isset($extendedData->working_hours)) ? $extendedData->working_hours : null, ['class' => 'form-control', 'placeholder' => 'Horarios']) !!}
    @if ($errors->has('working_hours')) <p class="help-block">{{ $errors->first('working_hours') }}</p> @endif
</div>
<!-- Website -->
<div class="form-group @if ($errors->has('website')) has-error @endif">
    {!! Form::label('website', 'Website') !!}
    {!! Form::text('website', (isset($extendedData->website)) ? $extendedData->website : null, ['class' => 'form-control', 'placeholder' => 'Website']) !!}
    @if ($errors->has('website')) <p class="help-block">{{ $errors->first('website') }}</p> @endif
</div>
<!-- Latitude -->
<div class="form-group @if ($errors->has('latitude')) has-error @endif">
    {!! Form::label('latitude', 'Latitud') !!}
    {!! Form::text('latitude', (isset($extendedData->latitude)) ? $extendedData->latitude : null, ['class' => 'form-control', 'placeholder' => 'Latitud']) !!}
    @if ($errors->has('latitude')) <p class="help-block">{{ $errors->first('latitude') }}</p> @endif
</div>
<!-- Longitude -->
<div class="form-group @if ($errors->has('longitude')) has-error @endif">
    {!! Form::label('longitude', 'Longitud') !!}
    {!! Form::text('longitude', (isset($extendedData->longitude)) ? $extendedData->longitude : null, ['class' => 'form-control', 'placeholder' => 'Longitud']) !!}
    @if ($errors->has('longitude')) <p class="help-block">{{ $errors->first('longitude') }}</p> @endif
</div>
<!-- Contact Email -->
<div class="form-group @if ($errors->has('contact_email')) has-error @endif">
    {!! Form::label('contact_email', 'Email de contacto') !!}
    {!! Form::text('contact_email', (isset($extendedData->contact_email)) ? $extendedData->contact_email : null, ['class' => 'form-control', 'placeholder' => 'Email de contacto']) !!}
    @if ($errors->has('contact_email')) <p class="help-block">{{ $errors->first('contact_email') }}</p> @endif
</div>
<!-- Contact Name 1 -->
<div class="form-group @if ($errors->has('contact_name_1')) has-error @endif">
    {!! Form::label('contact_name_1', 'Nombre de contacto administrativo 1') !!}
    {!! Form::text('contact_name_1', (isset($extendedData->contact_name_1)) ? $extendedData->contact_name_1 : null, ['class' => 'form-control', 'placeholder' => 'Nombre de contacto administrativo 1']) !!}
    @if ($errors->has('contact_name_1')) <p class="help-block">{{ $errors->first('contact_name_1') }}</p> @endif
</div>
<!-- Contact Email 1 -->
<div class="form-group @if ($errors->has('contact_email_1')) has-error @endif">
    {!! Form::label('contact_email_1', 'Email de contacto administrativo 1') !!}
    {!! Form::text('contact_email_1', (isset($extendedData->contact_email_1)) ? $extendedData->contact_email_1 : null, ['class' => 'form-control', 'placeholder' => 'Email de contacto administrativo 1']) !!}
    @if ($errors->has('contact_email_1')) <p class="help-block">{{ $errors->first('contact_email_1') }}</p> @endif
</div>
<!-- Contact Skype 1 -->
<div class="form-group @if ($errors->has('contact_skype_1')) has-error @endif">
    {!! Form::label('contact_skype_1', 'Skype de contacto administrativo 1') !!}
    {!! Form::text('contact_skype_1', (isset($extendedData->contact_skype_1)) ? $extendedData->contact_skype_1 : null, ['class' => 'form-control', 'placeholder' => 'Skype de contacto administrativo 1']) !!}
    @if ($errors->has('contact_skype_1')) <p class="help-block">{{ $errors->first('contact_skype_1') }}</p> @endif
</div>
<!-- Contact Phone 1 -->
<div class="form-group @if ($errors->has('contact_phone_1')) has-error @endif">
    {!! Form::label('contact_phone_1', 'Teléfono de contacto administrativo 1') !!}
    {!! Form::text('contact_phone_1', (isset($extendedData->contact_phone_1)) ? $extendedData->contact_phone_1 : null, ['class' => 'form-control', 'placeholder' => 'Teléfono de contacto administrativo 1']) !!}
    @if ($errors->has('contact_phone_1')) <p class="help-block">{{ $errors->first('contact_phone_1') }}</p> @endif
</div>
<!-- Contact Name 2 -->
<div class="form-group @if ($errors->has('contact_name_2')) has-error @endif">
    {!! Form::label('contact_name_2', 'Nombre de contacto administrativo 2') !!}
    {!! Form::text('contact_name_2', (isset($extendedData->contact_name_2)) ? $extendedData->contact_name_2 : null, ['class' => 'form-control', 'placeholder' => 'Nombre de contacto administrativo 2']) !!}
    @if ($errors->has('contact_name_2')) <p class="help-block">{{ $errors->first('contact_name_2') }}</p> @endif
</div>
<!-- Contact Email 2 -->
<div class="form-group @if ($errors->has('contact_email_2')) has-error @endif">
    {!! Form::label('contact_email_2', 'Email de contacto administrativo 2') !!}
    {!! Form::text('contact_email_2', (isset($extendedData->contact_email_2)) ? $extendedData->contact_email_2 : null, ['class' => 'form-control', 'placeholder' => 'Email de contacto administrativo 2']) !!}
    @if ($errors->has('contact_email_2')) <p class="help-block">{{ $errors->first('contact_email_2') }}</p> @endif
</div>
<!-- Contact Skype 2 -->
<div class="form-group @if ($errors->has('contact_skype_2')) has-error @endif">
    {!! Form::label('contact_skype_2', 'Skype de contacto administrativo 2') !!}
    {!! Form::text('contact_skype_2', (isset($extendedData->contact_skype_2)) ? $extendedData->contact_skype_2 : null, ['class' => 'form-control', 'placeholder' => 'Skype de contacto administrativo 2']) !!}
    @if ($errors->has('contact_skype_2')) <p class="help-block">{{ $errors->first('contact_skype_2') }}</p> @endif
</div>
<!-- Contact Phone 2 -->
<div class="form-group @if ($errors->has('contact_phone_2')) has-error @endif">
    {!! Form::label('contact_phone_2', 'Teléfono de contacto administrativo 2') !!}
    {!! Form::text('contact_phone_2', (isset($extendedData->contact_phone_2)) ? $extendedData->contact_phone_2 : null, ['class' => 'form-control', 'placeholder' => 'Teléfono de contacto administrativo 2']) !!}
    @if ($errors->has('contact_phone_2')) <p class="help-block">{{ $errors->first('contact_phone_2') }}</p> @endif
</div>
<!-- Contact Name 3 -->
<div class="form-group @if ($errors->has('contact_name_3')) has-error @endif">
    {!! Form::label('contact_name_3', 'Nombre de contacto administrativo 3') !!}
    {!! Form::text('contact_name_3', (isset($extendedData->contact_name_3)) ? $extendedData->contact_name_3 : null, ['class' => 'form-control', 'placeholder' => 'Nombre de contacto administrativo 3']) !!}
    @if ($errors->has('contact_name_3')) <p class="help-block">{{ $errors->first('contact_name_3') }}</p> @endif
</div>
<!-- Contact Email 3 -->
<div class="form-group @if ($errors->has('contact_email_3')) has-error @endif">
    {!! Form::label('contact_email_3', 'Email de contacto administrativo 3') !!}
    {!! Form::text('contact_email_3', (isset($extendedData->contact_email_3)) ? $extendedData->contact_email_3 : null, ['class' => 'form-control', 'placeholder' => 'Email de contacto administrativo 3']) !!}
    @if ($errors->has('contact_email_3')) <p class="help-block">{{ $errors->first('contact_email_3') }}</p> @endif
</div>
<!-- Contact Skype 3 -->
<div class="form-group @if ($errors->has('contact_skype_3')) has-error @endif">
    {!! Form::label('contact_skype_3', 'Skype de contacto administrativo 3') !!}
    {!! Form::text('contact_skype_3', (isset($extendedData->contact_skype_3)) ? $extendedData->contact_skype_3 : null, ['class' => 'form-control', 'placeholder' => 'Skype de contacto administrativo 3']) !!}
    @if ($errors->has('contact_skype_3')) <p class="help-block">{{ $errors->first('contact_skype_3') }}</p> @endif
</div>
<!-- Contact Phone 3 -->
<div class="form-group @if ($errors->has('contact_phone_3')) has-error @endif">
    {!! Form::label('contact_phone_3', 'Teléfono de contacto administrativo 3') !!}
    {!! Form::text('contact_phone_3', (isset($extendedData->contact_phone_3)) ? $extendedData->contact_phone_3 : null, ['class' => 'form-control', 'placeholder' => 'Teléfono de contacto administrativo 3']) !!}
    @if ($errors->has('contact_phone_3')) <p class="help-block">{{ $errors->first('contact_phone_3') }}</p> @endif
</div>
<!-- CUIT -->
<div class="form-group @if ($errors->has('cuit')) has-error @endif">
    {!! Form::label('cuit', 'CUIT') !!}
    {!! Form::text('cuit', (isset($extendedData->cuit)) ? $extendedData->cuit : null, ['class' => 'form-control', 'placeholder' => 'CUIT']) !!}
    @if ($errors->has('cuit')) <p class="help-block">{{ $errors->first('cuit') }}</p> @endif
</div>
<!-- IIBB -->
<div class="form-group @if ($errors->has('iibb')) has-error @endif">
    {!! Form::label('iibb', 'IIBB') !!}
    {!! Form::text('iibb', (isset($extendedData->iibb)) ? $extendedData->iibb : null, ['class' => 'form-control', 'placeholder' => 'IIBB']) !!}
    @if ($errors->has('iibb')) <p class="help-block">{{ $errors->first('iibb') }}</p> @endif
</div>
<!-- Part Sending Method -->
<div class="form-group @if ($errors->has('part_sending_method')) has-error @endif">
    {!! Form::label('part_sending_method', 'Método de envio de partes') !!}
    {!! Form::text('part_sending_method', (isset($extendedData->part_sending_method)) ? $extendedData->part_sending_method : null, ['class' => 'form-control', 'placeholder' => 'Método de envio de partes']) !!}
    @if ($errors->has('part_sending_method')) <p class="help-block">{{ $errors->first('part_sending_method') }}</p> @endif
</div>

{!! Form::text('roles[]', $role->id, ['class' => 'hidden']) !!}
@if(!empty($user->id))
    {!! Form::text('id', $user->id, ['class' => 'hidden']) !!}
@endif

{{--
<!-- Roles Form Input -->
<div class="form-group @if ($errors->has('roles')) has-error @endif">
    {!! Form::label('roles[]', 'Roles') !!}
    {!! Form::select('roles[]', $roles, isset($user) ? $user->roles->pluck('id')->toArray() : null,  ['class' => 'form-control', 'multiple']) !!}
    @if ($errors->has('roles')) <p class="help-block">{{ $errors->first('roles') }}</p> @endif
</div>
--}}

<!-- Permissions -->
{{--
@if(isset($user))
    @include('shared._permissions', ['closed' => 'true', 'model' => $user ])
@endif
--}}