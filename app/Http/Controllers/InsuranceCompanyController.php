<?php

namespace App\Http\Controllers;

use App\InsuranceCompany;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Response;

class InsuranceCompanyController extends Controller
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

        $result = InsuranceCompany::all();

        return view('insurance_company.index', compact('result'));
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

        return view('insurance_company.new');
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
            'insurance_company' => 'required|min:1'
        ]);

        $user = Auth::user();
        if($user->hasRole('Admin') || $user->hasRole('Call')){
            $insurance_company                      = new InsuranceCompany();
            $insurance_company->insurance_company   = $request->get('insurance_company');
            $insurance_company->save();

            flash('La Compañía Aseguradora ha sido creada.');
        }else{
            flash()->error('Las Compañías Aseguradoras sólo pueden ser creadas por un Admin o usuario Call.');
        }

        return redirect()->route('insurance_companies.index');
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

        $id_insurance_company   = $request->get('id');
        $insurance_company      = InsuranceCompany::findOrFail($id_insurance_company);

        return view('insurance_company.edit', compact(['insurance_company']));
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
            'insurance_company' => 'required'
        ]);

        $user = Auth::user();
        if($user->hasRole('Admin') || $user->hasRole('Call')){
            $id_insurance_company                   = $request->get('id');
            $insurance_company                      = InsuranceCompany::findOrFail($id_insurance_company);
            $insurance_company->insurance_company   = $request->get('insurance_company');
            $insurance_company->save();

            flash()->success('La Compañía Aseguradora ha sido actualizada.');
        }else{
            flash()->error('Las Compañías Aseguradoras sólo pueden ser actualizadas por un Admin o usuario Call.');
        }

        return redirect()->route('insurance_companies.index');
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
            $insurance_company  = InsuranceCompany::findOrFail($id);
            $insurance_company->delete();
            flash()->success('La Compañía Aseguradora ha sido borrada.');
        }else{
            flash()->error('Las Compañías Aseguradoras sólo pueden ser borradas por un Admin o usuario Call.');
        }

        return redirect()->route('insurance_companies.index');
    }
}
