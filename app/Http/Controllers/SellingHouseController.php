<?php

namespace App\Http\Controllers;

use App\SellingHouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Response;

class SellingHouseController extends Controller
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

        $result = SellingHouse::all();

        return view('selling_house.index', compact('result'));
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

        return view('selling_house.new');
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
            'business_name' => 'required'
        ]);

        $user = Auth::user();
        if($user->hasRole('Admin') || $user->hasRole('Call')){
            $selling_house                  = new SellingHouse();
            $selling_house->business_name   = $request->get('business_name');
            $selling_house->address         = $request->get('address');
            $selling_house->contact         = $request->get('contact');
            $selling_house->phone           = $request->get('phone');
            $selling_house->email           = $request->get('email');
            $selling_house->save();

            flash('La Casa Vendedora ha sido creada.');
        }else{
            flash()->error('Las Casas Vendedoras sólo pueden ser creadas por un Admin o usuario Call.');
        }

        return redirect()->route('selling_houses.index');
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

        $id_selling_house    = $request->get('id');
        $selling_house       = SellingHouse::findOrFail($id_selling_house);

        return view('selling_house.edit', compact(['selling_house']));
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
            'business_name' => 'required'
        ]);

        $user = Auth::user();
        if($user->hasRole('Admin') || $user->hasRole('Call')){
            $id_selling_house               = $request->get('id');
            $selling_house                  = SellingHouse::findOrFail($id_selling_house);
            $selling_house->business_name   = $request->get('business_name');
            $selling_house->address         = $request->get('address');
            $selling_house->contact         = $request->get('contact');
            $selling_house->phone           = $request->get('phone');
            $selling_house->email           = $request->get('email');
            $selling_house->save();

            flash()->success('La Casa Vendedora ha sido actualizada.');
        }else{
            flash()->error('Las Casas Vendedoras sólo pueden ser actualizadas por un Admin o usuario Call.');
        }

        return redirect()->route('selling_houses.index');
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
            $selling_house  = SellingHouse::findOrFail($id);
            $selling_house->delete();
            flash()->success('La Casa Vendedora ha sido borrada.');
        }else{
            flash()->error('Las Casas Vendedoras sólo pueden ser borradas por un Admin o usuario Call.');
        }

        return redirect()->route('selling_houses.index');
    }
}
