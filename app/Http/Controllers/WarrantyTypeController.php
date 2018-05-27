<?php

namespace App\Http\Controllers;

use App\WarrantyType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Response;

class WarrantyTypeController extends Controller
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

        $result = WarrantyType::all();

        return view('warranty_type.index', compact('result'));
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

        return view('warranty_type.new');
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
            'warranty_type' => 'required'
        ]);

        $user = Auth::user();
        if($user->hasRole('Admin') || $user->hasRole('Call')){
            $warranty_type                  = new WarrantyType();
            $warranty_type->warranty_type   = $request->get('warranty_type');
            $warranty_type->save();

            flash('El Tipo de Garantía ha sido creado.');
        }else{
            flash()->error('Los Tipos de Garantías sólo pueden ser creados por un Admin o usuario Call.');
        }

        return redirect()->route('warranty_types.index');
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

        $id_warranty_type   = $request->get('id');
        $warranty_type      = WarrantyType::findOrFail($id_warranty_type);

        return view('warranty_type.edit', compact(['warranty_type']));
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
            'warranty_type' => 'required'
        ]);

        $user = Auth::user();
        if($user->hasRole('Admin') || $user->hasRole('Call')){
            $id_warranty_type               = $request->get('id');
            $warranty_type                  = WarrantyType::findOrFail($id_warranty_type);
            $warranty_type->warranty_type   = $request->get('warranty_type');
            $warranty_type->save();

            flash()->success('El Tipo de Garantía ha sido actualizado.');
        }else{
            flash()->error('Los Tipos de Garantías sólo pueden ser actualizados por un Admin o usuario Call.');
        }

        return redirect()->route('warranty_types.index');
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
            $id             = $request->get('id');
            $warranty_type  = WarrantyType::findOrFail($id);
            $warranty_type->delete();
            flash()->success('El Tipo de Garantía ha sido borrado.');
        }else{
            flash()->error('Los Tipos de Garantías sólo pueden ser borradas por un Admin o usuario Call.');
        }

        return redirect()->route('warranty_types.index');
    }
}
