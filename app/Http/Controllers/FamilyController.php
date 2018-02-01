<?php

namespace App\Http\Controllers;

use App\Family;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Response;

class FamilyController extends Controller
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

        $result = Family::latest()->paginate();

        return view('family.index', compact('result'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Controller::addCss('/css/bootstrap-datetimepicker-build.css');
        Controller::addJsFooter('/js/moment_js/moment.js');
        Controller::addJsFooter('/js/bootstrap-datetimepicker.js');

        $families = Family::all(['family', 'id']);

        return view('family.new', compact(['families']));
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
            'family' => 'required|min:1'
        ]);

        $user = Auth::user();
        if($user->hasRole('Admin') || $user->hasRole('Call')){
            $family             = new Family();
            $family->family     = $request->get('family');
            $family->id_parent  = $request->get('id_parent');
            $family->save();

            flash('La Familia ha sido creada.');
        }else{
            flash()->error('Las Familias sólo pueden ser creadas por un Admin o usuario Call.');
        }

        return redirect()->route('families.index');
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

        $id_family  = $request->get('id');
        $family     = Family::findOrFail($id_family);
        $families   = Family::all(['family', 'id']);

        return view('family.edit', compact(['family', 'families']));
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
            'family' => 'required'
        ]);

        $user = Auth::user();
        if($user->hasRole('Admin') || $user->hasRole('Call')){
            $id_family          = $request->get('id');
            $family             = Family::findOrFail($id_family);
            $family->family     = $request->get('family');
            $family->id_parent  = $request->get('id_parent');
            $family->save();

            flash()->success('La Familia ha sido actualizada.');
        }else{
            flash()->error('Las Familias sólo pueden ser actualizadas por un Admin o usuario Call.');
        }

        return redirect()->route('families.index');
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

        if($me->hasRole('Admin') || $me->hasRole('Call')){
            $id         = $request->get('id');
            $family     = Family::findOrFail($id);
            $family->delete();
            flash()->success('La Familia ha sido borrada.');
        }else{
            flash()->error('Las Familias sólo pueden ser borradas por un Admin o usuario Call.');
        }

        return redirect()->route('families.index');
    }
}
