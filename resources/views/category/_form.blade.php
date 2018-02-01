<!-- Category -->
<div class="form-group @if ($errors->has('category')) has-error @endif">
    {!! Form::label('category', 'Categoría') !!}
    {!! Form::text('category', (isset($category->category)) ? $category->category : null, ['class' => 'form-control', 'placeholder' => 'Categoría']) !!}
    @if ($errors->has('category')) <p class="help-block">{{ $errors->first('category') }}</p> @endif
</div>