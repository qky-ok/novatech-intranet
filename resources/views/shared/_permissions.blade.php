@if(!empty($permissions))
    <div class="panel panel-default">
        <div class="panel-heading" role="tab" id="{{ isset($title) ? str_slug($title) :  'permissionHeading' }}">
            <h4 class="panel-title">
                <a role="button" data-toggle="collapse" data-parent="#accordion" href="#dd-{{ isset($title) ? str_slug($title) :  'permissionHeading' }}" aria-expanded="{{ $closed or 'true' }}" aria-controls="dd-{{ isset($title) ? str_slug($title) :  'permissionHeading' }}">
                    {{ $title or 'Sobreescribir Permisos' }} {!! isset($user) ? '<span class="text-danger">(' . $user->getDirectPermissions()->count() . ')</span>' : '' !!}
                </a><span>Permisos / Ver Estados</span>
            </h4>
        </div>
        <div id="dd-{{ isset($title) ? str_slug($title) :  'permissionHeading' }}" class="panel-collapse collapse {{ $closed or 'in' }}" role="tabpanel" aria-labelledby="dd-{{ isset($title) ? str_slug($title) :  'permissionHeading' }}">
            <div class="panel-body">
                <div class="row">
                    <h4 class="permissions-panel-title">Permisos</h4>

                    @foreach($permissions as $perm)
                        <?php
                            $per_found = null;

                            if( isset($role) ) {
                                $per_found = $role->hasPermissionTo($perm->name);
                            }

                            if( isset($user)) {
                                $per_found = $user->hasDirectPermission($perm->name);
                            }
                        ?>

                        <div class="col-md-3">
                            <div class="checkbox">
                                <label class="{{ str_contains($perm->name, 'delete') ? 'text-danger' : '' }}">
                                    {!! Form::checkbox("permissions[]", $perm->name, $per_found, isset($options) ? $options : []) !!} {{ $perm->name }}
                                </label>
                            </div>
                        </div>
                    @endforeach
                </div>

                @if(!empty($states))
                    <div class="row">
                        <h4 class="permissions-panel-title view-states">Ver Estados</h4>


                        @foreach($states as $state)
                            <?php
                            $per_found = null;

                            if(isset($role)){
                                $per_found = $role->canViewState($state->id);
                            }

                            ?>

                            <div class="col-md-3">
                                <div class="checkbox">
                                    <label>
                                        {!! Form::checkbox("states[]", $state->id, $per_found, isset($options) ? $options : []) !!} {{ $state->name }}
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
@endif