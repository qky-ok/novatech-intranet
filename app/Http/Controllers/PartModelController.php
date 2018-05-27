<?php

namespace App\Http\Controllers;

use App\PartModel;
use App\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Response;

class PartModelController extends Controller
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

        $result = PartModel::all();

        return view('part_model.index', compact('result'));
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

        $brands = Brand::all(['brand', 'id']);

        return view('part_model.new', compact(['brands']));
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
            'part_model' => 'required|min:1'
        ]);

        $user = Auth::user();
        if($user->hasRole('Admin') || $user->hasRole('Call')){
            $part_model             = new PartModel();
            $part_model->part_model = $request->get('part_model');
            $part_model->id_brand   = $request->get('id_brand');
            $part_model->save();

            flash('El Modelo ha sido creado.');
        }else{
            flash()->error('Los Modelos sólo pueden ser creados por un Admin o usuario Call.');
        }

        return redirect()->route('part_models.index');
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

        $id_part_model  = $request->get('id');
        $part_model     = PartModel::findOrFail($id_part_model);
        $brands         = Brand::all(['brand', 'id']);

        return view('part_model.edit', compact(['part_model', 'brands']));
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
            'part_model' => 'required'
        ]);

        $user = Auth::user();
        if($user->hasRole('Admin') || $user->hasRole('Call')){
            $id_part_model          = $request->get('id');
            $part_model             = PartModel::findOrFail($id_part_model);
            $part_model->part_model = $request->get('part_model');
            $part_model->id_brand   = $request->get('id_brand');
            $part_model->save();

            flash()->success('El Modelo ha sido actualizado.');
        }else{
            flash()->error('Los Modelos sólo pueden ser actualizados por un Admin o usuario Call.');
        }

        return redirect()->route('part_models.index');
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
            $part_model = PartModel::findOrFail($id);
            $part_model->delete();
            flash()->success('El Modelo ha sido borrado.');
        }else{
            flash()->error('Los Modelos sólo pueden ser borrados por un Admin o usuario Call.');
        }

        return redirect()->route('part_models.index');
    }
}
