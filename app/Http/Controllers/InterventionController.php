<?php

namespace App\Http\Controllers;

use App\Intervention;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Response;

class InterventionController extends Controller
{
    function __construct(){
        parent::__construct();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        Controller::addCss('/js/datatables_1.10.16/datatables.min.css');
        Controller::addJsFooter('/js/datatables_1.10.16/datatables.min.js');

        $result = Intervention::all();

        return view('intervention.index', compact('result'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        return view('intervention.new');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $this->validate($request, [
            'title' => 'required|min:1'
        ]);

        $intervention           = new Intervention();
        $intervention->title    = $request->get('title');
        $intervention->amount   = $request->get('amount');
        $intervention->save();

        flash('La Intervención ha sido creada.');

        return redirect()->route('interventions.index');
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

        Controller::addCss('/css/bootstrap-datetimepicker-build.css');
        Controller::addJsFooter('/js/moment_js/moment.js');
        Controller::addJsFooter('/js/bootstrap-datetimepicker.js');

        $id_intervention  = $request->get('id');
        $intervention     = Intervention::findOrFail($id_intervention);

        return view('intervention.edit', compact(['intervention']));
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
            'id'    => 'required|min:1',
            'title' => 'required'
        ]);

        $user = Auth::user();
        if($user->hasRole('Admin')){
            $id_intervention        = $request->get('id');
            $intervention           = Intervention::findOrFail($id_intervention);
            $intervention->title    = $request->get('title');
            $intervention->amount   = $request->get('amount');
            $intervention->save();

            flash()->success('La Intervención ha sido actualizada.');
        }else{
            flash()->error('Las Intervenciones sólo pueden ser actualizadas por un Admin.');
        }

        return redirect()->route('interventions.index');
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

        $me = Auth::user();

        if($me->hasRole('Admin')){
            $id         = $request->get('id');
            $intervention   = Intervention::findOrFail($id);
            $intervention->delete();
            flash()->success('La Intervención ha sido borrado.');
        }else{
            flash()->error('Las Intervenciones sólo pueden ser borradas por un Admin.');
        }

        return redirect()->route('interventions.index');
    }
}
