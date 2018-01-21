<?php

namespace App\Http\Controllers;

use App\Authorizable;
use App\Permission;
use App\Role;
use App\State;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller{
    use Authorizable;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles          = Role::all();
        $permissions    = Permission::all();
        $states         = State::all();

        return view('role.index', compact('roles', 'permissions', 'states'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, ['name' => 'required|unique:roles']);

        if( Role::create($request->only('name')) ) {
            flash('Role Added');
        }

        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request){
        $validator = Validator::make($request->all(), [
            'default_email' => 'nullable|email'
        ]);

        if($validator->fails()){
            flash()->error('El email ingresado no es válido.');
            return  redirect()->route('roles.index');
        }

        $id = $request->get('id');

        if($role = Role::findOrFail($id)) {
            // role default email
            $default_email = (!empty($request->get('default_email')) ) ? $request->get('default_email') : null;
            $role->default_email = $default_email;
            $role->save();

            // admin role has everything
            if($role->name === 'Admin') {
                $role->syncPermissions(Permission::all());
                return redirect()->route('roles.index');
            }

            $permissions = $request->get('permissions', []);
            $role->syncPermissions($permissions);

            $states         = $request->get('states', []);
            $states_mails   = $request->get('sends_mail', []);
            $role->syncViewStates($states);
            $role->syncSendEmail($states_mails);

            flash( $role->name.': permisos actualizados.');
        } else {
            flash()->error('El Rol con ID '.$id.' no ha sido encontrado.');
        }

        return redirect()->route('roles.index');
    }
}
