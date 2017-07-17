@can('edit_users')
    {!! Form::open( ['method' => 'get', 'url' => route($entity.'.edit'), 'style' => 'display: inline']) !!}
        {!! Form::text('id', $id, ['class' => 'hidden']) !!}
        <button type="submit" class="btn-delete btn btn-xs btn-warning">
            <i class="glyphicon glyphicon-edit"></i>
        </button>
    {!! Form::close() !!}
@endcan

@can('delete_users')
    {!! Form::open( ['method' => 'delete', 'url' => route($entity.'.destroy'), 'style' => 'display: inline', 'onSubmit' => 'return confirm("Are you sure you want to delete this Item?")']) !!}
        {!! Form::text('id', $id, ['class' => 'hidden']) !!}
        <button type="submit" class="btn-delete btn btn-xs btn-danger">
            <i class="glyphicon glyphicon-trash"></i>
        </button>
    {!! Form::close() !!}
@endcan