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
        $result = State::latest()->paginate();
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

            flash('State has been created.');
        } else {
            flash()->error('Unable to create state.');
        }

        return redirect()->route('states.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
        $state = State::find($id);
        return view('state.edit', compact('state'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){
        $this->validate($request, [
            'name' => 'bail|required|min:2'
        ]);

        // Get the state
        $state = State::findOrFail($id);

        // Update state
        $state->name = $request->get('name');
        $state->save();

        flash()->success('State has been updated.');

        return redirect()->route('states.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     * @internal param Request $request
     */
    public function destroy($id){
        if(State::findOrFail($id)->delete()){
            flash()->success('State has been deleted');
        }else{
            flash()->success('State not deleted');
        }

        return redirect()->back();
    }
}
