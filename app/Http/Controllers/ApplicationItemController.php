<?php

namespace App\Http\Controllers;

use App\ApplicationItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Response;

class ApplicationItemController extends Controller
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

        $result = ApplicationItem::latest()->paginate();

        return view('application_item.index', compact('result'));
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

        return view('application_item.new');
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
            'application_item' => 'required|min:1'
        ]);

        $user = Auth::user();
        if($user->hasRole('Admin') || $user->hasRole('Call')){
            $application_item                   = new ApplicationItem();
            $application_item->application_item = $request->get('application_item');
            $application_item->save();

            flash('La Aplicación / Rubro ha sido creado.');
        }else{
            flash()->error('Las Aplicaciones / Rubros sólo pueden ser creados por un Admin o usuario Call.');
        }

        return redirect()->route('application_items.index');
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

        $id_application_item    = $request->get('id');
        $application_item       = ApplicationItem::findOrFail($id_application_item);

        return view('application_item.edit', compact(['application_item']));
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
            'id'                => 'required|min:1',
            'application_item'  => 'required'
        ]);

        $user = Auth::user();
        if($user->hasRole('Admin') || $user->hasRole('Call')){
            $id_application_item                = $request->get('id');
            $application_item                   = ApplicationItem::findOrFail($id_application_item);
            $application_item->application_item = $request->get('application_item');
            $application_item->save();

            flash()->success('La Aplicación / Rubro ha sido actualizado.');
        }else{
            flash()->error('Las Aplicaciones / Rubros sólo pueden ser actualizados por un Admin o usuario Call.');
        }

        return redirect()->route('application_items.index');
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
            $id                 = $request->get('id');
            $application_item   = ApplicationItem::findOrFail($id);
            $application_item->delete();
            flash()->success('La Aplicación / Rubro ha sido borrada.');
        }else{
            flash()->error('Las Aplicaciones / Rubros sólo pueden ser borrados por un Admin o usuario Call.');
        }

        return redirect()->route('application_items.index');
    }
}
