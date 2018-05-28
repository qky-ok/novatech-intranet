<?php

namespace App\Http\Controllers;

use App\Part;
use App\PartPart;
use App\ModelPart;
use App\PartImage;
use App\ApplicationItem;
use App\Brand;
use App\PartModel;
use App\Family;
use App\Provider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Storage;
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

        $result = Part::all();

        return view('part.index', compact('result'));
    }

    /**
     * Show a resource.
     *
     * @param  Int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){
        Controller::addCss('/css/colorbox/colorbox.css');
        Controller::addJsFooter('/js/colorbox/jquery.colorbox-min.js');
        Controller::addJsFooter('/js/part_show.js');

        $part   = Part::findOrFail($id);
        $models = PartModel::all(['part_model', 'id']);
        $parts  = Part::all(['description', 'id']);

        return view('part.show', compact('part', 'models', 'parts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Controller::addCss('/css/bootstrap-datetimepicker-build.css');
        Controller::addCss('/css/dropzone_5.2/dropzone.min.css');
        Controller::addJsFooter('/js/moment_js/moment.js');
        Controller::addJsFooter('/js/bootstrap-datetimepicker.js');
        Controller::addJsFooter('/js/dropzone_5.2/dropzone.min.js');
        Controller::addJsFooter('/js/part.js');

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
            $part->id_family            = $request->get('id_family');
            $part->id_sub_family        = $request->get('id_sub_family');
            $part->id_provider          = $request->get('id_provider');
            $part->num_part             = $request->get('num_part');
            $part->description          = $request->get('description');
            $part->weight               = $request->get('weight');
            $part->warranty_months      = $request->get('warranty_months');
            $part->discontinuous        = $request->get('discontinuous');
            $part->scrap                = $request->get('scrap');
            $part->deposit_stock        = $request->get('deposit_stock');
            $part->save();

            if(!empty($request->get('part_parts'))){
                foreach($request->get('part_parts') as $id_replacement_part){
                    if($id_replacement_part){
                        $part_parts                         = new PartPart;
                        $part_parts->id_part                = $part->id;
                        $part_parts->id_replacement_part    = $id_replacement_part;
                        $part_parts->save();
                    }
                }
            }

            if(!empty($request->get('part_models'))){
                foreach($request->get('part_models') as $id_model){
                    if($id_model){
                        $models_parts           = new ModelPart;
                        $models_parts->id_part  = $part->id;
                        $models_parts->id_model = $id_model;
                        $models_parts->save();
                    }
                }
            }

            if(!empty($request->get('part_images'))){
                foreach($request->get('part_images') as $part_image_file_name){
                    $parts_images               = new PartImage;
                    $parts_images->id_part      = $part->id;
                    $parts_images->file_name    = $part_image_file_name;
                    $parts_images->save();
                }
            }

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
        Controller::addCss('/css/dropzone_5.2/dropzone.min.css');
        Controller::addJsFooter('/js/moment_js/moment.js');
        Controller::addJsFooter('/js/bootstrap-datetimepicker.js');
        Controller::addJsFooter('/js/dropzone_5.2/dropzone.min.js');
        Controller::addJsFooter('/js/part.js');

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
            $part->id_family            = $request->get('id_family');
            $part->id_sub_family        = $request->get('id_sub_family');
            $part->id_provider          = $request->get('id_provider');
            $part->num_part             = $request->get('num_part');
            $part->description          = $request->get('description');
            $part->weight               = $request->get('weight');
            $part->warranty_months      = $request->get('warranty_months');
            $part->discontinuous        = $request->get('discontinuous');
            $part->scrap                = $request->get('scrap');
            $part->deposit_stock        = $request->get('deposit_stock');
            $part->save();

            $resetPartsParts = PartPart::where('id_part', $id_part)->delete();

            if(!empty($request->get('part_parts'))){
                foreach($request->get('part_parts') as $id_replacement_part){
                    if($id_replacement_part){
                        $part_parts                         = new PartPart;
                        $part_parts->id_part                = $id_part;
                        $part_parts->id_replacement_part    = $id_replacement_part;
                        $part_parts->save();
                    }
                }
            }

            $resetModelsParts = ModelPart::where('id_part', $id_part)->delete();

            if(!empty($request->get('part_models'))){
                foreach($request->get('part_models') as $id_model){
                    if($id_model){
                        $models_parts           = new ModelPart;
                        $models_parts->id_part  = $id_part;
                        $models_parts->id_model = $id_model;
                        $models_parts->save();
                    }
                }
            }

            if(!empty($request->get('part_images'))){
                foreach($request->get('part_images') as $part_image_file_name){
                    $parts_images               = new PartImage;
                    $parts_images->id_part      = $part->id;
                    $parts_images->file_name    = $part_image_file_name;
                    $parts_images->save();
                }
            }

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

    /**
     * Upload a photo for the Part.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function uploadImage(Request $request){
        $user = Auth::user();
        if($user->hasRole('Admin') || $user->hasRole('Call')){
            $file       = $request->file('file_name');
            $fileName   = $file->getClientOriginalName();
            Storage::disk('part_images') -> put($fileName, file_get_contents($file->getRealPath()));

            return response()->json($fileName, 200);
        }else{
            return response()->json('Error', 400);
        }
    }

    /**
     * Delete a photo for the Part.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function deleteImage(Request $request){
        $file_id    = $request->get('file_id');
        $file_name  = $request->get('file_name');

        if(Storage::disk('part_images')->exists($file_name)){
            Storage::disk('part_images')->delete($file_name);

            $part_image = PartImage::findOrFail($file_id);
            $part_image->delete();

            $returnData     = "Imagen eliminada con éxito";
            $returnStatus   = 200;
        }else{
            $returnData     = "Imagen no encontrada";
            $returnStatus   = 404;
        }

        return response()->json($returnData, $returnStatus);
    }
}
