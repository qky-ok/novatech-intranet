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

<!-- Contact Phone 1 Input -->
<div class="form-group @if ($errors->has('contact_phone_1')) has-error @endif">
    {!! Form::label('contact_phone_1', 'Teléfono 1') !!}
    {!! Form::text('contact_phone_1', (!empty($extendedData->contact_phone_1)) ? $extendedData->contact_phone_1 : null, ['class' => 'form-control', 'placeholder' => '011-123-4567']) !!}
    @if ($errors->has('contact_phone_1')) <p class="help-block">{{ $errors->first('contact_phone_1') }}</p> @endif
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
@if(isset($user))
    @include('shared._permissions', ['closed' => 'true', 'model' => $user ])
@endif