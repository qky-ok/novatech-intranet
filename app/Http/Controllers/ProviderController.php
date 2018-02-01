<?php

namespace App\Http\Controllers;

use App\Provider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Response;

class ProviderController extends Controller
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

        $result = Provider::latest()->paginate();

        return view('provider.index', compact('result'));
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

        return view('provider.new');
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
            'provider' => 'required|min:1'
        ]);

        $user = Auth::user();
        if($user->hasRole('Admin') || $user->hasRole('Call')){
            $provider           = new Provider();
            $provider->provider = $request->get('provider');
            $provider->save();

            flash('El Proveedor ha sido creado.');
        }else{
            flash()->error('Los Proveedores sólo pueden ser creados por un Admin o usuario Call.');
        }

        return redirect()->route('providers.index');
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

        $id_provider  = $request->get('id');
        $provider     = Provider::findOrFail($id_provider);

        return view('provider.edit', compact(['provider']));
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
            'id'        => 'required|min:1',
            'provider'  => 'required'
        ]);

        $user = Auth::user();
        if($user->hasRole('Admin') || $user->hasRole('Call')){
            $id_provider        = $request->get('id');
            $provider           = Provider::findOrFail($id_provider);
            $provider->provider = $request->get('provider');
            $provider->save();

            flash()->success('El Proveedor ha sido actualizado.');
        }else{
            flash()->error('Los Proveedores sólo pueden ser actualizados por un Admin o usuario Call.');
        }

        return redirect()->route('providers.index');
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
            $provider   = Provider::findOrFail($id);
            $provider->delete();
            flash()->success('El Proveedor ha sido borrado.');
        }else{
            flash()->error('Los Proveedores sólo pueden ser borrados por un Admin o usuario Call.');
        }

        return redirect()->route('providers.index');
    }
}
