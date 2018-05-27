<?php

namespace App\Http\Controllers;

use App\State;
use App\Authorizable;
use Illuminate\Http\Request;

class StateController extends Controller
{
    use Authorizable;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        Controller::addCss('/js/datatables_1.10.16/datatables.min.css');
        Controller::addJsFooter('/js/datatables_1.10.16/datatables.min.js');

        $result = State::all();
        return view('state.index', compact('result'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        return view('state.new');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $this->validate($request, [
            'name' => 'bail|required|min:2'
        ]);

        // Create the State
        $state          = new State;
        $state->name    = $request->name;

        if($state->save()){
            $state->viewRoles()->attach(1); // Admin

            flash('El Estado ha sido creado.');
        } else {
            flash()->error('El Estado no pudo crearse.');
        }

        return redirect()->route('states.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request){
        $this->validate($request, [
            'id' => 'required'
        ]);

        $id     = $request->get('id');
        $state  = State::find($id);
        return view('state.edit', compact('state'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request){
        $this->validate($request, [
            'id'    => 'required',
            'name'  => 'bail|required|min:2'
        ]);

        // Get the state
        $id     = $request->get('id');
        $state  = State::findOrFail($id);

        // Update state
        $state->name = $request->get('name');
        $state->save();

        flash()->success('El Estado ha sido actualizado.');

        return redirect()->route('states.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * @internal param Request $request
     */
    public function destroy(Request $request){
        $this->validate($request, [
            'id' => 'required'
        ]);

        $id = $request->get('id');
        if(State::findOrFail($id)->delete()){
            flash()->success('El Estado ha sido borrado');
        }else{
            flash()->warning('El Estado no pudo borrarse');
        }

        return redirect()->back();
    }
}
