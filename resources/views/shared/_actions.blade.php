@if($entity === 'application_items' || $entity === 'selling_houses' || $entity === 'categories' || $entity === 'clients' || $entity === 'insurance_companies' || $entity === 'families' || $entity === 'warranties' || $entity === 'brands' || $entity === 'part_models' || $entity === 'parts' || $entity === 'providers' || $entity === 'warranty_types' || $entity === 'interventions' || $entity === 'billings')
    {!! Form::open( ['method' => 'get', 'url' => route($entity.'.edit'), 'style' => 'display: inline']) !!}
    {!! Form::text('id', $id, ['class' => 'hidden']) !!}
    <button type="submit" class="btn-delete btn btn-xs btn-warning">
        <i class="glyphicon glyphicon-edit"></i>
    </button>
    {!! Form::close() !!}

    {!! Form::open( ['method' => 'post', 'url' => route($entity.'.destroy'), 'style' => 'display: inline', 'onSubmit' => 'return confirm("Esta seguro que desea eliminar éste Item?")']) !!}
    {!! Form::text('id', $id, ['class' => 'hidden']) !!}
    <button type="submit" class="btn-delete btn btn-xs btn-danger">
        <i class="glyphicon glyphicon-trash"></i>
    </button>
    {!! Form::close() !!}
@endif

@if($entity === 'parts')
    {!! Form::open( ['method' => 'get', 'route' => [$entity.'.show', $id], 'style' => 'display: inline']) !!}
    <button type="submit" class="btn-delete btn btn-xs btn-info">
        <i class="glyphicon glyphicon-eye-open"></i>
    </button>
    {!! Form::close() !!}
@endif

@if($entity === 'services')
    @can('edit_services')
        {!! Form::open( ['method' => 'get', 'url' => route($entity.'.edit'), 'style' => 'display: inline']) !!}
        {!! Form::text('id', $id, ['class' => 'hidden']) !!}
        <button type="submit" class="btn-delete btn btn-xs btn-warning">
            <i class="glyphicon glyphicon-edit"></i>
        </button>
        {!! Form::close() !!}
    @endcan

    @can('delete_services')
        {!! Form::open( ['method' => 'post', 'url' => route($entity.'.destroy'), 'style' => 'display: inline', 'onSubmit' => 'return confirm("Esta seguro que desea eliminar éste Item?")']) !!}
        {!! Form::text('id', $id, ['class' => 'hidden']) !!}
        <button type="submit" class="btn-delete btn btn-xs btn-danger">
            <i class="glyphicon glyphicon-trash"></i>
        </button>
        {!! Form::close() !!}
    @endcan
@endif

@if($entity === 'users')
    @can('edit_users')
        {!! Form::open( ['method' => 'get', 'url' => route($entity.'.edit'), 'style' => 'display: inline']) !!}
            {!! Form::text('id', $id, ['class' => 'hidden']) !!}
            <button type="submit" class="btn-delete btn btn-xs btn-warning">
                <i class="glyphicon glyphicon-edit"></i>
            </button>
        {!! Form::close() !!}
    @endcan

    @can('delete_users')
        {!! Form::open( ['method' => 'post', 'url' => route($entity.'.destroy'), 'style' => 'display: inline', 'onSubmit' => 'return confirm("Esta seguro que desea eliminar éste Item?")']) !!}
            {!! Form::text('id', $id, ['class' => 'hidden']) !!}
            <button type="submit" class="btn-delete btn btn-xs btn-danger">
                <i class="glyphicon glyphicon-trash"></i>
            </button>
        {!! Form::close() !!}
    @endcan
@endif