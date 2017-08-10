<?php

namespace App\Http\Controllers;

use App\Authorizable;
use App\Service;
use App\ServiceHistory;
use App\State;
use App\User;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Response;

class ServiceController extends Controller
{
    use Authorizable;

    function __construct(){
        parent::__construct();

        Controller::addJsFooter('/js/service.js');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        Controller::addCss('/js/datatables_1.10.15/datatables.min.css');
        Controller::addJsFooter('/js/datatables_1.10.15/datatables.min.js');

        $role = Auth::user()->roles->first()->id;
        if($role == env('CAS_USER')){
            $result = Service::where('id_user', Auth::user()->id)->paginate();
        }else{
            $result = Service::latest()->paginate();
        }

        return view('service.index', compact('result'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $states     = State::pluck('name', 'id');
        $users      = User::all(['name', 'id']);
        $cas_users  = [];

        foreach($users as $user){
            if($user->getUserRoleId() == env('CAS_USER')) $cas_users[] = $user;
        }

        return view('service.new', compact(['states', 'cas_users']));
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
            'id_state'      => 'required|min:1',
            'id_user'       => 'required|min:1',
            'title'         => 'required|min:5',
            'description'   => 'required|min:10'
        ]);

        $service                = new Service();
        $service->id_state      = $request->get('id_state');
        $service->id_user       = $request->get('id_user');
        $service->title         = $request->get('title');
        $service->description   = $request->get('description');
        $service->save();

        $serviceHistory                 = new ServiceHistory();
        $serviceHistory->id_service     = $service->id;
        $serviceHistory->id_user        = Auth::user()->id;
        $serviceHistory->id_state       = $service->id_state;
        $serviceHistory->edited_fields  = 'todos';
        $serviceHistory->save();

        flash('El Service ha sido creado.');

        return redirect()->route('services.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function show(Service $service)
    {
        //
    }

    /**
     * Search a specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search(String $search){
        $search     = filter_var($search, FILTER_SANITIZE_STRING);
        $service    = Service::where('title', $search)->first();
        $return     = ['error' => 'not found'];
        $status     = 404;

        if(!empty($service)){
            $role_id    = (Auth::guest()) ? 2 : Auth::user()->roles->first()->id; // User(2) es el default del guest
            $state_id   = $service->state()->id;
            $state_name = '';
            $role       = Role::where('id', $role_id)->first();

            if($role->canViewState($state_id)){
                $state_name = $service->state()->name;
            }else{
                $service_history = $service->history();

                foreach($service_history as $incidence){
                    if($incidence->id_state != null){
                        if($role->canViewState($incidence->id_state)){
                            $state      = State::where('id', $incidence->id_state)->first();
                            $state_name = $state->name;
                            break;
                        }
                    }
                }
            }

            if($state_name != ''){
                $return = [
                    'id'            => $service->id,
                    'title'         => $service->title,
                    'description'   => $service->description,
                    'state'         => $state_name,
                ];

                $status = 200;
            }
        }

        return Response::json($return, $status);
    }

    /**
     * Display the specified resource's history.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getHistory(Request $request){
        $this->validate($request, [
            'id' => 'required|min:1'
        ]);

        $id_service = $request->get('id');
        $service    = Service::findOrFail($id_service);
        $history    = $service->history();
        $role       = Role::where('id', Auth::user()->roles->first()->id)->first();

        return view('service.history', compact(['service', 'history', 'role']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request){
        $this->validate($request, [
            'id' => 'required|min:1'
        ]);

        $id_service = $request->get('id');
        $service    = Service::findOrFail($id_service);
        $states     = State::pluck('name', 'id');
        $users      = User::all(['name', 'id']);
        $cas_users  = [];

        foreach($users as $user){
            if($user->getUserRoleId() == env('CAS_USER')) $cas_users[] = $user;
        }

        return view('service.edit', compact(['service', 'states', 'cas_users']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'id'            => 'required|min:1',
            'id_state'      => 'required|min:1',
            'id_user'       => 'required|min:1',
            'title'         => 'required|min:5',
            'description'   => 'required|min:10'
        ]);

        $user = Auth::user();
        if($user->hasRole('Admin') || $user->hasRole('Call') || $user->hasRole('CAS')) {
            $edited_fields          = [];
            $id_service             = $request->get('id');
            $service                = Service::findOrFail($id_service);

            $old_id_state           = $service->id_state;
            $old_id_user            = $service->id_user;
            $old_title              = $service->title;
            $old_description        = $service->description;

            $service->id_state      = $request->get('id_state');
            $service->id_user       = $request->get('id_user');
            $service->title         = $request->get('title');
            $service->description   = $request->get('description');
            $service->save();

            if($service->id_user != $old_id_user)           $edited_fields[]    = 'usuario';
            if($service->title != $old_title)               $edited_fields[]    = 'título';
            if($service->description != $old_description)   $edited_fields[]    = 'descripción';

            $serviceHistory                 = new ServiceHistory();
            $serviceHistory->id_service     = $id_service;
            $serviceHistory->id_user        = $user->id;
            $serviceHistory->id_state       = ($service->id_state != $old_id_state) ? $service->id_state : null;
            $serviceHistory->edited_fields  = (!empty($edited_fields)) ? implode('|', $edited_fields) : null;
            $serviceHistory->save();

            flash()->success('El Service ha sido actualizado.');
        }else{

        }

        return redirect()->route('services.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request){
        $this->validate($request, [
            'id' => 'required|min:1'
        ]);

        $id = $request->get('id');
        $me = Auth::user();

        if( $me->hasRole('Admin') ) {
            $service = Service::findOrFail($id);
        } else {
            $service = $me->services()->findOrFail($id);
        }

        $service->delete();

        flash()->success('El Service ha sido borrado.');

        return redirect()->route('services.index');
    }
}
