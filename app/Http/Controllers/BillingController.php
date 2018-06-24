<?php

namespace App\Http\Controllers;

use App\Billing;
use App\BillingService;
use App\Service;
use App\ServiceIntervention;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Response;

class BillingController extends Controller
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

        $user                   = Auth::user();
        $billing_services_ids   = [];
        if($user->hasRole('CAS')){
            $billing = Billing::where('id_user', $user->id)->get();
        }else{
            $billing = Billing::all();
        }

        if(!empty($billing)){
            foreach($billing as $billing_row){
                $billing_services = BillingService::where('id_billing', $billing_row->id)->get();

                if(!empty($billing_services)){
                    foreach($billing_services as $billing_service){
                        $billing_services_ids[] = $billing_service->id_service;
                    }
                }
            }
        }

        $servicesForBilling     = [];
        $servicesForBillingRaw  = Service::where([['cas_stock', '=', 0], ['id_user', '=', $user->id], ['id_state', '=', 5]])->get(); // id_state = 5 -> Entregado

        if(!empty($servicesForBillingRaw)){
            foreach($servicesForBillingRaw as $serviceForBilling){
                if(!in_array($serviceForBilling->id, $billing_services_ids)) $servicesForBilling[] = $serviceForBilling;
            }
        }

        return view('billing.index', compact('billing', 'servicesForBilling'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request){
        Controller::addCss('/css/bootstrap-datetimepicker-build.css');
        Controller::addJsFooter('/js/moment_js/moment.js');
        Controller::addJsFooter('/js/bootstrap-datetimepicker.js');

        $this->validate($request, [
            'service_ids' => 'required'
        ]);

        $service_ids                        = $request->get('service_ids');
        $service_ids_str                    = implode(',', $service_ids);
        $service_interventions              = [];
        $id_user                            = Service::select('id_user')->where('id', $service_ids[0])->first()->id_user;
        $billing_service_intervention_total = 0;

        foreach($service_ids as $service_id){
            $service_interventions_raw = ServiceIntervention::where('id_service', $service_id)->get();

            if(!empty($service_interventions_raw)){
                foreach($service_interventions_raw as $service_intervention_raw){
                    $service_interventions[] = $service_intervention_raw->intervention();
                    $billing_service_intervention_total += $service_intervention_raw->intervention()->amount;
                }
            }
        }

        return view('billing.new', compact('service_interventions', 'id_user', 'billing_service_intervention_total', 'service_ids_str'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $this->validate($request, [
            'bill_number' => 'required'
        ]);

        $billing                = new Billing();
        $billing->id_user       = $request->get('id_user');
        $billing->id_state      = $request->get('id_state');
        $billing->bill_number   = $request->get('bill_number');
        $date                   = $request->get('billing_date');
        if(!empty($date)){
            $date                   = explode('-', $date);
            $billing->billing_date  = $date[2].'-'.$date[1].'-'.$date[0].' 00:00:00';
        }else{
            $billing->billing_date = '1970-01-01 00:00:00';
        }
        $billing->save();

        $service_ids_str        = $request->get('service_ids_str');
        $service_ids            = (strstr($service_ids_str, ',')) ? explode(',', $service_ids_str) : [$service_ids_str];
        foreach($service_ids as $service_id){
            $service_interventions_raw = ServiceIntervention::where('id_service', $service_id)->get();

            if(!empty($service_interventions_raw)){
                foreach($service_interventions_raw as $service_intervention_raw){
                    $service_intervention           = $service_intervention_raw->intervention();

                    $billing_service                = new BillingService();
                    $billing_service->id_billing    = $billing->id;
                    $billing_service->id_service    = $service_intervention_raw->id_service;
                    $billing_service->intervention  = $service_intervention->title;
                    $billing_service->amount        = $service_intervention->amount;
                    $billing_service->save();
                }
            }
        }

        flash('La Factura ha sido creada.');

        return redirect()->route('billings.index');
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

        $id_billing                         = $request->get('id');
        $billing                            = Billing::findOrFail($id_billing);
        $service_interventions              = [];
        $service_interventions_raw          = BillingService::where('id_billing', $id_billing)->get();
        $billing_service_intervention_total = 0;

        if(!empty($service_interventions_raw)){
            foreach($service_interventions_raw as $service_intervention_raw){
                $service_intervention       = ['title' => $service_intervention_raw->intervention, 'amount' => $service_intervention_raw->amount];
                $service_interventions[]    = (object) $service_intervention;
                $billing_service_intervention_total += $service_intervention_raw->amount;
            }
        }

        return view('billing.edit', compact(['billing', 'service_interventions', 'billing_service_intervention_total']));
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
            'id'            => 'required',
            'bill_number'   => 'required',
            'billing_date'  => 'required'
        ]);

        $id_billing             = $request->get('id');
        $billing                = Billing::findOrFail($id_billing);
        $billing->id_user       = $request->get('id_user');
        $billing->id_state      = $request->get('id_state');
        $billing->bill_number   = $request->get('bill_number');
        $date                   = $request->get('billing_date');
        if(!empty($date)){
            $date                   = explode('-', $date);
            $billing->billing_date  = $date[2].'-'.$date[1].'-'.$date[0].' 00:00:00';
        }else{
            $billing->billing_date = '1970-01-01 00:00:00';
        }
        $billing->save();

        return redirect()->route('billings.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request){
        $this->validate($request, [
            'id' => 'required'
        ]);

        $id_billing = $request->get('id');
        $billing    = Billing::findOrFail($id_billing);
        $billing->delete();
        BillingService::where('id_billing', $id_billing)->delete();

        flash()->success('La Factura ha sido borrada.');

        return redirect()->route('billings.index');
    }
}
