<?php

namespace App\Http\Controllers;

use App\Authorizable;
use App\Service;
use App\ServiceHistory;
use App\State;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ServiceController extends Controller
{
    use Authorizable;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result = Service::latest()->paginate();
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
        $serviceHistory->edited_fields  = 'all';
        $serviceHistory->save();

        flash('Service has been added');

        return redirect()->back();
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

        return view('service.history', compact(['service', 'history']));
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

            if($service->id_user != $old_id_user)           $edited_fields[]    = 'id_user';
            if($service->title != $old_title)               $edited_fields[]    = 'title';
            if($service->description != $old_description)   $edited_fields[]    = 'description';

            $serviceHistory                 = new ServiceHistory();
            $serviceHistory->id_service     = $id_service;
            $serviceHistory->id_user        = $user->id;
            $serviceHistory->id_state       = ($service->id_state != $old_id_state) ? $service->id_state : null;
            $serviceHistory->edited_fields  = (!empty($edited_fields)) ? implode('|', $edited_fields) : null;
            $serviceHistory->save();

            flash()->success('Service has been updated.');
        }else{

        }

        return redirect()->route('services.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function destroy(Service $service)
    {
        $me = Auth::user();

        if( $me->hasRole('Admin') ) {
            $service = Service::findOrFail($service->id);
        } else {
            $service = $me->services()->findOrFail($service->id);
        }

        $service->delete();

        flash()->success('Service has been deleted.');

        return redirect()->route('services.index');
    }
}