<?php

namespace App\Http\Controllers;

use App\Warranty;
use App\WarrantyType;
use App\InsuranceCompany;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Response;

class WarrantyController extends Controller
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

        $result = Warranty::all();

        return view('warranty.index', compact('result'));
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

        $warranty_types         = WarrantyType::all(['warranty_type', 'id']);
        $insurance_companies    = InsuranceCompany::all(['insurance_company', 'id']);

        return view('warranty.new', compact(['warranty_types', 'insurance_companies']));
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
            'num_warranty' => 'required'
        ]);

        $user = Auth::user();
        if($user->hasRole('Admin') || $user->hasRole('Call')){
            $warranty                       = new Warranty();

            $date_purchase                  = $request->get('date_purchase');
            if(!empty($date_purchase)){
                $date_purchase              = explode('-', $date_purchase);
                $warranty->date_purchase    = $date_purchase[2].'-'.$date_purchase[1].'-'.$date_purchase[0].' 00:00:00';
            }else{
                $warranty->date_purchase = '1970-01-01 00:00:00';
            }

            $date_failure                   = $request->get('date_failure');
            if(!empty($date_purchase)){
                $date_failure           = explode('-', $date_failure);
                $warranty->date_failure = $date_failure[2].'-'.$date_failure[1].'-'.$date_failure[0].' 00:00:00';
            }else{
                $warranty->date_failure = '1970-01-01 00:00:00';
            }

            $date_fabrication               = $request->get('date_fabrication');
            if(!empty($date_fabrication)){
                $date_fabrication           = explode('-', $date_fabrication);
                $warranty->date_fabrication = $date_fabrication[2].'-'.$date_fabrication[1].'-'.$date_fabrication[0].' 00:00:00';
            }else{
                $warranty->date_fabrication = '1970-01-01 00:00:00';
            }

            $date_insurance_expiration                  = $request->get('date_insurance_expiration');
            if(!empty($date_insurance_expiration)){
                $date_insurance_expiration              = explode('-', $date_insurance_expiration);
                $warranty->date_insurance_expiration    = $date_insurance_expiration[2].'-'.$date_insurance_expiration[1].'-'.$date_insurance_expiration[0].' 00:00:00';
            }else{
                $warranty->date_insurance_expiration = '1970-01-01 00:00:00';
            }

            $warranty->id_warranty_type     = $request->get('id_warranty_type');
            $warranty->id_insurance_company = $request->get('id_insurance_company');
            $warranty->num_warranty         = $request->get('num_warranty');
            $warranty->num_purchase_bill    = $request->get('num_purchase_bill');
            $warranty->num_refund           = $request->get('num_refund');
            $warranty->num_authorization    = $request->get('num_authorization');
            $warranty->num_imei             = $request->get('num_imei');
            $warranty->num_insurance        = $request->get('num_insurance');
            $warranty->precedence           = $request->get('precedence');
            $warranty->warranty_extension   = $request->get('warranty_extension');
            $warranty->exception            = $request->get('exception');
            $warranty->save();

            flash('La Garantía ha sido creada.');
        }else{
            flash()->error('Las Garantías sólo pueden ser creadas por un Admin o usuario Call.');
        }

        return redirect()->route('warranties.index');
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
        Controller::addJsFooter('/js/service.js');

        $id_warranty            = $request->get('id');
        $warranty               = Warranty::findOrFail($id_warranty);
        $warranty_types         = WarrantyType::all(['warranty_type', 'id']);
        $insurance_companies    = InsuranceCompany::all(['insurance_company', 'id']);

        return view('warranty.edit', compact(['warranty', 'warranty_types', 'insurance_companies']));
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
            'num_warranty'  => 'required'
        ]);

        $user = Auth::user();
        if($user->hasRole('Admin') || $user->hasRole('Call')){
            $id_warranty                    = $request->get('id');
            $warranty                       = Warranty::findOrFail($id_warranty);

            $date_purchase                  = $request->get('date_purchase');
            if(!empty($date_purchase)){
                $date_purchase              = explode('-', $date_purchase);
                $warranty->date_purchase    = $date_purchase[2].'-'.$date_purchase[1].'-'.$date_purchase[0].' 00:00:00';
            }else{
                $warranty->date_purchase = '1970-01-01 00:00:00';
            }

            $date_failure                   = $request->get('date_failure');
            if(!empty($date_failure)){
                $date_failure           = explode('-', $date_failure);
                $warranty->date_failure = $date_failure[2].'-'.$date_failure[1].'-'.$date_failure[0].' 00:00:00';
            }else{
                $warranty->date_failure = '1970-01-01 00:00:00';
            }

            $date_fabrication               = $request->get('date_fabrication');
            if(!empty($date_fabrication)){
                $date_fabrication           = explode('-', $date_fabrication);
                $warranty->date_fabrication = $date_fabrication[2].'-'.$date_fabrication[1].'-'.$date_fabrication[0].' 00:00:00';
            }else{
                $warranty->date_fabrication = '1970-01-01 00:00:00';
            }

            $date_insurance_expiration                  = $request->get('date_insurance_expiration');
            if(!empty($date_insurance_expiration)){
                $date_insurance_expiration              = explode('-', $date_insurance_expiration);
                $warranty->date_insurance_expiration    = $date_insurance_expiration[2].'-'.$date_insurance_expiration[1].'-'.$date_insurance_expiration[0].' 00:00:00';
            }else{
                $warranty->date_insurance_expiration = '1970-01-01 00:00:00';
            }

            $warranty->id_warranty_type     = $request->get('id_warranty_type');
            $warranty->id_insurance_company = $request->get('id_insurance_company');
            $warranty->num_warranty         = $request->get('num_warranty');
            $warranty->num_purchase_bill    = $request->get('num_purchase_bill');
            $warranty->num_refund           = $request->get('num_refund');
            $warranty->num_authorization    = $request->get('num_authorization');
            $warranty->num_imei             = $request->get('num_imei');
            $warranty->num_insurance        = $request->get('num_insurance');
            $warranty->precedence           = $request->get('precedence');
            $warranty->warranty_extension   = $request->get('warranty_extension');
            $warranty->exception            = $request->get('exception');
            $warranty->save();

            flash()->success('La Garantía ha sido actualizada.');
        }else{
            flash()->error('Las Garantías sólo pueden ser actualizadas por un Admin o usuario Call.');
        }

        return redirect()->route('warranties.index');
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
            $warranty   = Warranty::findOrFail($id);
            $warranty->delete();
            flash()->success('La Garantía ha sido borrada.');
        }else{
            flash()->error('Las Garantías sólo pueden ser borradas por un Admin o usuario Call.');
        }

        return redirect()->route('warranties.index');
    }
}
