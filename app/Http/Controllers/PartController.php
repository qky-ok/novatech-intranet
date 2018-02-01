<?php

namespace App\Http\Controllers;

use App\Part;
use App\ApplicationItem;
use App\Brand;
use App\PartModel;
use App\Family;
use App\Provider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Response;

class PartController extends Controller
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

        $result = Part::latest()->paginate();

        return view('part.index', compact('result'));
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

        $application_items  = ApplicationItem::all(['application_item', 'id']);
        $brands             = Brand::all(['brand', 'id']);
        $models             = PartModel::all(['part_model', 'id']);
        $families           = Family::all(['family', 'id']);
        $parts              = Part::all(['description', 'id']);
        $providers          = Provider::all(['provider', 'id']);

        return view('part.new', compact(['application_items', 'brands', 'models', 'families', 'parts', 'providers']));
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
            'description' => 'required|min:1'
        ]);

        $user = Auth::user();
        if($user->hasRole('Admin') || $user->hasRole('Call')){
            $part                       = new Part();
            $part->id_application_item  = $request->get('id_application_item');
            $part->id_brand             = $request->get('id_brand');
            $part->id_model             = $request->get('id_model');
            $part->id_family            = $request->get('id_family');
            $part->id_sub_family        = $request->get('id_sub_family');
            $part->id_replacement_part  = $request->get('id_replacement_part');
            $part->id_provider          = $request->get('id_provider');
            $part->num_part             = $request->get('num_part');
            $part->description          = $request->get('description');
            $part->weight               = $request->get('weight');
            $part->warranty_months      = $request->get('warranty_months');
            $part->discontinuous        = $request->get('discontinuous');
            $part->scrap                = $request->get('scrap');
            //$part->images             = $request->get('images');
            $part->save();

            flash('La Parte ha sido creada.');
        }else{
            flash()->error('Las Marcas sólo pueden ser creadas por un Admin o usuario Call.');
        }

        return redirect()->route('parts.index');
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

        $id_part            = $request->get('id');
        $part               = Part::findOrFail($id_part);
        $application_items  = ApplicationItem::all(['application_item', 'id']);
        $brands             = Brand::all(['brand', 'id']);
        $models             = PartModel::all(['part_model', 'id']);
        $families           = Family::all(['family', 'id']);
        $parts              = Part::all(['description', 'id']);
        $providers          = Provider::all(['provider', 'id']);

        return view('part.edit', compact(['part', 'application_items', 'brands', 'models', 'families', 'parts', 'providers']));
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
            'description'   => 'required|min:1'
        ]);

        $user = Auth::user();
        if($user->hasRole('Admin') || $user->hasRole('Call')){
            $id_part                    = $request->get('id');
            $part                       = Part::findOrFail($id_part);
            $part->id_application_item  = $request->get('id_application_item');
            $part->id_brand             = $request->get('id_brand');
            $part->id_model             = $request->get('id_model');
            $part->id_family            = $request->get('id_family');
            $part->id_sub_family        = $request->get('id_sub_family');
            $part->id_replacement_part  = $request->get('id_replacement_part');
            $part->id_provider          = $request->get('id_provider');
            $part->num_part             = $request->get('num_part');
            $part->description          = $request->get('description');
            $part->weight               = $request->get('weight');
            $part->warranty_months      = $request->get('warranty_months');
            $part->discontinuous        = $request->get('discontinuous');
            $part->scrap                = $request->get('scrap');
            //$part->images             = $request->get('images');
            $part->save();

            flash()->success('La Parte ha sido actualizada.');
        }else{
            flash()->error('Las Marcas sólo pueden ser actualizadas por un Admin o usuario Call.');
        }

        return redirect()->route('parts.index');
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
            $id     = $request->get('id');
            $part   = Part::findOrFail($id);
            $part->delete();
            flash()->success('La Parte ha sido borrada.');
        }else{
            flash()->error('Las Marcas sólo pueden ser borradas por un Admin o usuario Call.');
        }

        return redirect()->route('parts.index');
    }
}
