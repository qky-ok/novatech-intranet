<?php

namespace App\Http\Controllers;

use App\Client;
use App\State;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Response;

class ClientController extends Controller
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

        $result = Client::latest()->paginate();

        return view('client.index', compact('result'));
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

        $states = State::all();

        return view('client.new', compact('states'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        if($user->hasRole('Admin') || $user->hasRole('Call')){
            $client                         = new Client();
            $date                           = $request->get('date_created');
            if(!empty($date)){
                $date                   = explode('-', $date);
                $client->date_created   = $date[2].'-'.$date[1].'-'.$date[0].' 00:00:00';
            }else{
                $client->date_created = '1970-01-01 00:00:00';
            }
            $client->id_price_list          = $request->get('id_price_list');
            $client->business_name          = $request->get('business_name');
            $client->sex                    = $request->get('sex');
            $client->company                = $request->get('company');
            $client->address                = $request->get('address');
            $client->province               = $request->get('province');
            $client->locality               = $request->get('locality');
            $client->postal_code            = $request->get('postal_code');
            $client->cuit                   = $request->get('cuit');
            $client->doc_type               = $request->get('doc_type');
            $client->doc                    = $request->get('doc');
            $client->iva_relation           = $request->get('iva_relation');
            $client->phone_home             = $request->get('phone_home');
            $client->phone_work             = $request->get('phone_work');
            $client->phone_mobile           = $request->get('phone_mobile');
            $client->mobile_company         = $request->get('mobile_company');
            $client->fax                    = $request->get('fax');
            $client->skype                  = $request->get('skype');
            $client->email                  = $request->get('email');
            $client->website                = $request->get('website');
            $client->blacklist              = $request->get('blacklist', 0);
            $client->send_services_amount   = $request->get('send_services_amount', 0);

            $client_services_states         = [];
            if(!empty($request->get('client_services_states'))){
                foreach($request->get('client_services_states') as $id_state){
                    if($id_state) $client_services_states[] = $id_state;
                }
            }
            $client->client_services_states = implode('|', $client_services_states);
            $client->save();

            flash('El Cliente ha sido creado.');
        }else{
            flash()->error('Los Clientes sólo pueden ser creados por un Admin o usuario Call.');
        }

        return redirect()->route('clients.index');
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

        $id_client              = $request->get('id');
        $client                 = Client::findOrFail($id_client);
        $states                 = State::all();
        $client_services_states = $client->states();

        return view('client.edit', compact(['client', 'states', 'client_services_states']));
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
            'id' => 'required|min:1'
        ]);

        $user = Auth::user();
        if($user->hasRole('Admin') || $user->hasRole('Call')){
            $id_client                      = $request->get('id');
            $client                         = Client::findOrFail($id_client);
            $date                           = $request->get('date_created');
            if(!empty($date)){
                $date                   = explode('-', $date);
                $client->date_created   = $date[2].'-'.$date[1].'-'.$date[0].' 00:00:00';
            }else{
                $client->date_created = '1970-01-01 00:00:00';
            }
            $client->id_price_list          = $request->get('id_price_list');
            $client->business_name          = $request->get('business_name');
            $client->sex                    = $request->get('sex');
            $client->company                = $request->get('company');
            $client->address                = $request->get('address');
            $client->province               = $request->get('province');
            $client->locality               = $request->get('locality');
            $client->postal_code            = $request->get('postal_code');
            $client->cuit                   = $request->get('cuit');
            $client->doc_type               = $request->get('doc_type');
            $client->doc                    = $request->get('doc');
            $client->iva_relation           = $request->get('iva_relation');
            $client->phone_home             = $request->get('phone_home');
            $client->phone_work             = $request->get('phone_work');
            $client->phone_mobile           = $request->get('phone_mobile');
            $client->mobile_company         = $request->get('mobile_company');
            $client->fax                    = $request->get('fax');
            $client->skype                  = $request->get('skype');
            $client->email                  = $request->get('email');
            $client->website                = $request->get('website');
            $client->blacklist              = $request->get('blacklist',0);
            $client->send_services_amount   = $request->get('send_services_amount', 0);

            $client_services_states         = [];
            if(!empty($request->get('client_services_states'))){
                foreach($request->get('client_services_states') as $id_state){
                    if($id_state) $client_services_states[] = $id_state;
                }
            }
            $client->client_services_states = implode('|', $client_services_states);
            $client->save();

            flash()->success('El Cliente ha sido actualizado.');
        }else{
            flash()->error('Los Clientes sólo pueden ser actualizados por un Admin o usuario Call.');
        }

        return redirect()->route('clients.index');
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
            $client = Client::findOrFail($id);
            $client->delete();
            flash()->success('El Cliente ha sido borrado.');
        }else{
            flash()->error('Los Clientes sólo pueden ser borrados por un Admin o usuario Call.');
        }

        return redirect()->route('clients.index');
    }
}
