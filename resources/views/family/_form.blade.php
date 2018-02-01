<!-- Family -->
<div class="form-group @if ($errors->has('family')) has-error @endif">
    {!! Form::label('family', 'Familia') !!}
    {!! Form::text('family', (isset($family->family)) ? $family->family : null, ['class' => 'form-control', 'placeholder' => 'Familia']) !!}
    @if ($errors->has('family')) <p class="help-block">{{ $errors->first('family') }}</p> @endif
</div>

<!-- Brands Form Input -->
<div class="form-group @if ($errors->has('id_parent')) has-error @endif">
    {!! Form::label('id_parent', 'Familia padre') !!}
    <select class="form-control" name="id_parent">
        <option value="0">Seleccione una Familia padre</option>
        @foreach($families as $family_select)
            <option value="{{ $family_select->id }}" @if(isset($family->id_parent) && $family->id_parent == $family_select->id) selected="selected" @endif>{{ $family_select->family }}</option>
        @endforeach
    </select>

    @if ($errors->has('id_parent')) <p class="help-block">{{ $errors->first('id_parent') }}</p> @endif
</div>