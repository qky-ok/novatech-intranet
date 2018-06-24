<!-- Title -->
<div class="form-group @if ($errors->has('title')) has-error @endif">
    {!! Form::label('title', 'Título') !!}
    {!! Form::text('title', (isset($intervention->title)) ? $intervention->title : null, ['class' => 'form-control', 'placeholder' => 'Título']) !!}
    @if ($errors->has('title')) <p class="help-block">{{ $errors->first('title') }}</p> @endif
</div>

<!-- Amount -->
<div class="form-group @if ($errors->has('amount')) has-error @endif">
    {!! Form::label('amount', 'Costo') !!}
    {!! Form::text('amount', (isset($intervention->amount)) ? $intervention->amount : null, ['class' => 'form-control', 'placeholder' => 'Costo']) !!}
    @if ($errors->has('amount')) <p class="help-block">{{ $errors->first('amount') }}</p> @endif
</div>