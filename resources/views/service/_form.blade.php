<!-- States Form Input -->
<div class="form-group @if ($errors->has('id_state')) has-error @endif">
    {!! Form::label('id_state', 'Estado') !!}
    {!! Form::select('id_state', $states, isset($service) ? $service->id_state : null,  ['class' => 'form-control']) !!}
    @if ($errors->has('id_state')) <p class="help-block">{{ $errors->first('id_state') }}</p> @endif
</div>

<!-- CAS Users Form Input -->
<div class="form-group @if ($errors->has('id_user')) has-error @endif">
    {!! Form::label('id_user', 'CAS') !!}
    <select class="form-control" name="id_user">
        @foreach($cas_users as $cas_user)
            <option value="{{ $cas_user->id }}" @if(isset($service->id_user) && $service->id_user == $cas_user->id) selected="selected" @endif>{{ $cas_user->name }}</option>
        @endforeach
    </select>

    @if ($errors->has('id_user')) <p class="help-block">{{ $errors->first('id_user') }}</p> @endif
</div>

<!-- Title of Service Form Input -->
<div class="form-group @if ($errors->has('title')) has-error @endif">
    {!! Form::label('title', 'Título') !!}
    {!! Form::text('title', (isset($service->title)) ? $service->title : null, ['class' => 'form-control', 'placeholder' => 'Title of Service']) !!}
    @if ($errors->has('title')) <p class="help-block">{{ $errors->first('title') }}</p> @endif
</div>

<!-- Description Form Input -->
<div class="form-group @if ($errors->has('description')) has-error @endif">
    {!! Form::label('description', 'Descripción') !!}
    {!! Form::textarea('description', (isset($service->title)) ? $service->description : null, ['class' => 'form-control ckeditor', 'placeholder' => 'Description of Service...']) !!}
    @if ($errors->has('description')) <p class="help-block">{{ $errors->first('description') }}</p> @endif
</div>

@if(!empty($service->id))
    {!! Form::text('id', $service->id, ['class' => 'hidden']) !!}
@endif

@push('scripts')
<script src="{{ asset('js/ckeditor_4.7/ckeditor.js') }}"></script>
<script type="text/javascript">
    CKEDITOR.replace('description');
</script>
@endpush