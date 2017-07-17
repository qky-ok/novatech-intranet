<?php

namespace App\Http\Controllers;

use App\User;
use App\Role;
use App\Permission;
use App\Authorizable;
use App\UserAdmin;
use App\UserWeb;
use App\UserCall;
use App\UserCas;
use App\UserDeposito;
use App\UserCompras;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

class UserController extends Controller
{
    use Authorizable;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result = User::latest()->paginate();
        $roles  = Role::all();

        return view('user.index', compact('result'))->with('roles', $roles);
    }

    /**
     * Show the form for creating a new resource.
     * @param  Integer  $role_id
     * @return \Illuminate\Http\Response
     */
    public function create($role_id = 1){
        //$roles = Role::pluck('name', 'id');
        $role = Role::where('id', $role_id)->first();

        //return view('user.new', compact('roles'));
        return view('user.new')->with('role', $role);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name'      => 'bail|required|min:2',
            'email'     => 'required|email|unique:users',
            'password'  => 'required|min:6',
            'roles'     => 'required|min:1'
        ]);

        // hash password
        $request->merge(['password' => bcrypt($request->get('password'))]);

        // Create the user
        $user           = new User();
        $user->name     = $request->get('name');
        $user->email    = $request->get('email');
        $user->password = $request->get('password');
        $id_role        = $request->get('roles')[0];
        //if ( $user = User::create($request->except('roles', 'permissions')) ) {
        if($user->save()){
            $this->syncPermissions($request, $user);

            switch($id_role){
                case 1:
                    $extendedUser                   = new UserAdmin();
                    $extendedUser->id               = $user->id;
                    $extendedUser->contact_phone_1  = (!empty($request->get('contact_phone_1'))) ? $request->get('contact_phone_1') : null;
                    $extendedUser->save();
                break;
                case 2:
                    $extendedUser                   = new UserWeb();
                    $extendedUser->id               = $user->id;
                    $extendedUser->contact_phone_1  = (!empty($request->get('contact_phone_1'))) ? $request->get('contact_phone_1') : null;
                    $extendedUser->save();
                    break;
                case 3:
                    $extendedUser                   = new UserCall();
                    $extendedUser->id               = $user->id;
                    $extendedUser->contact_phone_1  = (!empty($request->get('contact_phone_1'))) ? $request->get('contact_phone_1') : null;
                    $extendedUser->save();
                    break;
                case 4:
                    $extendedUser                   = new UserCas();
                    $extendedUser->id               = $user->id;
                    $extendedUser->contact_phone_1  = (!empty($request->get('contact_phone_1'))) ? $request->get('contact_phone_1') : null;
                    $extendedUser->save();
                    break;
                case 5:
                    $extendedUser                   = new UserDeposito();
                    $extendedUser->id               = $user->id;
                    $extendedUser->contact_phone_1  = (!empty($request->get('contact_phone_1'))) ? $request->get('contact_phone_1') : null;
                    $extendedUser->save();
                    break;
                case 6:
                    $extendedUser                   = new UserCompras();
                    $extendedUser->id               = $user->id;
                    $extendedUser->contact_phone_1  = (!empty($request->get('contact_phone_1'))) ? $request->get('contact_phone_1') : null;
                    $extendedUser->save();
                    break;
                default:
                    $extendedUser                   = new UserWeb();
                    $extendedUser->id               = $user->id;
                    $extendedUser->contact_phone_1  = (!empty($request->get('contact_phone_1'))) ? $request->get('contact_phone_1') : null;
                    $extendedUser->save();
            }

            flash('User has been created.');
        }else{
            flash()->error('Unable to create user.');
        }

        return redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $this->validate($request, [
            'user' => 'required|min:1'
        ]);

        $id             = $request->get('user');
        $user           = User::find($id);
        $role           = Role::where('id', $user->getUserRoleId())->first();
        $extendedData   = $user->getExtendedData();
        $permissions    = Permission::all('name', 'id');

        return view('user.edit', compact('user', 'permissions'))->with('role', $role)->with('extendedData', $extendedData);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'id'    => 'required|min:1',
            'name'  => 'bail|required|min:2',
            'email' => 'required|email|unique:users,email,'.$request->get('id'),
            'roles' => 'required|min:1'
        ]);

        // Get the user
        $id_user    = $request->get('id');
        $user       = User::findOrFail($id_user);

        // Update user
        //$user->fill($request->except('roles', 'permissions', 'password'));
        $user->name     = $request->get('name');
        $user->email    = $request->get('email');
        $id_role        = $request->get('roles')[0];

        // check for password change
        if($request->get('password')) {
            $user->password = bcrypt($request->get('password'));
        }

        // Handle the user roles
        $this->syncPermissions($request, $user);

        $user->save();

        switch($id_role){
            case 1:
                $extendedUser                   = UserAdmin::findOrFail($user->id);
                $extendedUser->contact_phone_1  = (!empty($request->get('contact_phone_1'))) ? $request->get('contact_phone_1') : null;
                $extendedUser->save();
                break;
            case 2:
                $extendedUser                   = UserWeb::findOrFail($user->id);
                $extendedUser->contact_phone_1  = (!empty($request->get('contact_phone_1'))) ? $request->get('contact_phone_1') : null;
                $extendedUser->save();
                break;
            case 3:
                $extendedUser                   = UserCall::findOrFail($user->id);
                $extendedUser->contact_phone_1  = (!empty($request->get('contact_phone_1'))) ? $request->get('contact_phone_1') : null;
                $extendedUser->save();
                break;
            case 4:
                $extendedUser                   = UserCas::findOrFail($user->id);
                $extendedUser->contact_phone_1  = (!empty($request->get('contact_phone_1'))) ? $request->get('contact_phone_1') : null;
                $extendedUser->save();
                break;
            case 5:
                $extendedUser                   = UserDeposito::findOrFail($user->id);
                $extendedUser->contact_phone_1  = (!empty($request->get('contact_phone_1'))) ? $request->get('contact_phone_1') : null;
                $extendedUser->save();
                break;
            case 6:
                $extendedUser                   = UserCompras::findOrFail($user->id);
                $extendedUser->contact_phone_1  = (!empty($request->get('contact_phone_1'))) ? $request->get('contact_phone_1') : null;
                $extendedUser->save();
                break;
            default:
                $extendedUser                   = UserWeb::findOrFail($user->id);
                $extendedUser->contact_phone_1  = (!empty($request->get('contact_phone_1'))) ? $request->get('contact_phone_1') : null;
                $extendedUser->save();
        }

        flash()->success('User has been updated.');

        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response
     * @internal param Request $request
     */
    public function destroy(Request $request)
    {
        $this->validate($request, [
            'id' => 'required|min:1'
        ]);

        $id = $request->get('id');

        if ( Auth::user()->id == $id ) {
            flash()->warning('Deletion of currently logged in user is not allowed :(')->important();
            return redirect()->back();
        }

        $user       = User::findOrFail($id);
        $id_role    = $user->getUserRoleId();

        if($user->delete()){
            switch($id_role){
                case 1:
                    $extendedUser = UserAdmin::findOrFail($id);
                    $extendedUser->delete();
                break;
                case 2:
                    $extendedUser = UserWeb::findOrFail($id);
                    $extendedUser->delete();
                break;
                case 3:
                    $extendedUser = UserCall::findOrFail($id);
                    $extendedUser->delete();
                break;
                case 4:
                    $extendedUser = UserCas::findOrFail($id);
                    $extendedUser->delete();
                break;
                case 5:
                    $extendedUser = UserDeposito::findOrFail($id);
                    $extendedUser->delete();
                break;
                case 6:
                    $extendedUser = UserCompras::findOrFail($id);
                    $extendedUser->delete();
                break;
                default:
                    $extendedUser = UserWeb::findOrFail($id);
                    $extendedUser->delete();
            }

            DB::table('model_has_roles')->where('model_id', $id)->delete();

            flash()->success('User has been deleted');
        } else {
            flash()->success('User not deleted');
        }

        return redirect()->back();
    }

    /**
     * Sync roles and permissions
     *
     * @param Request $request
     * @param $user
     * @return string
     */
    private function syncPermissions(Request $request, $user)
    {
        // Get the submitted roles
        $roles = $request->get('roles', []);
        $permissions = $request->get('permissions', []);

        // Get the roles
        $roles = Role::find($roles);

        // check for current role changes
        if( ! $user->hasAllRoles( $roles ) ) {
            // reset all direct permissions for user
            $user->permissions()->sync([]);
        } else {
            // handle permissions
            $user->syncPermissions($permissions);
        }

        $user->syncRoles($roles);

        return $user;
    }
}
