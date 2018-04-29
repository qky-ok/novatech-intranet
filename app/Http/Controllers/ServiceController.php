<?php

namespace App\Http\Controllers;

use App\Authorizable;
use App\Brand;
use App\Category;
use App\Client;
use App\PartModel;
use App\SellingHouse;
use App\Service;
use App\ServiceHistory;
use App\State;
use App\User;
use App\Role;
use App\Mail\ServiceStateChanged;
use App\Warranty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Response;

class ServiceController extends Controller
{
    use Authorizable;

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
        Controller::addJsFooter('/js/service.js');

        $role = Auth::user()->roles->first()->id;
        if($role == env('CAS_USER')){
            $result = Service::where('id_user', Auth::user()->id)->paginate();
        }else{
            $result = Service::latest()->paginate();
        }

        return view('service.index', compact('result'));
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
        Controller::addJsFooter('/js/service.js');

        $states         = State::pluck('name', 'id');
        $users          = User::all(['name', 'id']);
        $cas_users      = [];
        $clients        = Client::all(['company', 'id']);
        $categories     = Category::all(['category', 'id']);
        $brands         = Brand::all(['brand', 'id']);
        $models         = PartModel::all(['part_model', 'id']);
        $selling_houses = SellingHouse::all(['business_name', 'id']);
        $warranties     = Warranty::all(['num_warranty', 'id']);

        foreach($users as $user){
            if($user->getUserRoleId() == env('CAS_USER')) $cas_users[] = $user;
        }

        return view('service.new', compact(['states', 'cas_users', 'clients', 'categories', 'brands', 'models', 'selling_houses', 'warranties']));
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
            'id_state'              => 'required|min:1',
            'id_user'               => 'required|min:1',
            'purchase_order_num'    => 'required|min:1'
        ]);

        $service                                = new Service();
        $service->id_state                      = $request->get('id_state');
        $service->id_user                       = $request->get('id_user');
        $service->id_client                     = $request->get('id_client');
        $service->id_category                   = $request->get('id_category');
        $service->id_brand                      = $request->get('id_brand');
        $service->id_model                      = $request->get('id_model');
        $service->id_selling_house              = $request->get('id_selling_house');
        $service->id_warranty                   = $request->get('id_warranty');
        $service->purchase_order_num            = $request->get('purchase_order_num');
        $service->serial_chasis                 = $request->get('serial_chasis');

        $date_in                                = $request->get('date_in');
        if(!empty($date_in)){
            $date_in            = explode('-', $date_in);
            $service->date_in   = $date_in[2].'-'.$date_in[1].'-'.$date_in[0].' 00:00:00';
        }else{
            $service->date_in = '1970-01-01 00:00:00';
        }

        $date_out                               = $request->get('date_out');
        if(!empty($date_out)){
            $date_out           = explode('-', $date_out);
            $service->date_out  = $date_out[2].'-'.$date_out[1].'-'.$date_out[0].' 00:00:00';
        }else{
            $service->date_out = '1970-01-01 00:00:00';
        }

        $date_commitment                        = $request->get('date_commitment');
        if(!empty($date_commitment)){
            $date_commitment            = explode('-', $date_commitment);
            $service->date_commitment   = $date_commitment[2].'-'.$date_commitment[1].'-'.$date_commitment[0].' 00:00:00';
        }else{
            $service->date_commitment = '1970-01-01 00:00:00';
        }

        $service->defect_according_to_client    = $request->get('defect_according_to_client');
        $service->equipment_type                = $request->get('equipment_type');
        $service->location                      = $request->get('location');
        $service->warranty                      = $request->get('warranty');
        $service->stock_reposition_doa          = $request->get('stock_reposition_doa');
        $service->pending_budget                = $request->get('pending_budget');
        $service->home_service                  = $request->get('home_service');
        $service->stock_repair                  = $request->get('stock_repair');
        $service->corrective_maintenance        = $request->get('corrective_maintenance');
        $service->pre_aproved_budget            = $request->get('pre_aproved_budget');
        $service->recolection_service           = $request->get('recolection_service');
        $service->preventive_maintenance        = $request->get('preventive_maintenance');
        $service->notes                         = $request->get('notes');
        $service->save();

        $serviceHistory                 = new ServiceHistory();
        $serviceHistory->id_service     = $service->id;
        $serviceHistory->id_user        = Auth::user()->id;
        $serviceHistory->id_state       = $service->id_state;
        $serviceHistory->edited_fields  = 'todos';
        $serviceHistory->save();

        //Send email if there are subscribers
        $this->sendEmail($service);

        flash('El Ticket ha sido creado.');

        return redirect()->route('services.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function show(Service $service)
    {
        //
    }

    /**
     * Search a specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search(String $search){
        $search     = filter_var($search, FILTER_SANITIZE_NUMBER_INT);
        $service    = Service::where('id', $search)->first();
        $return     = ['error' => 'not found'];
        $status     = 404;

        if(!empty($service)){
            $role_id    = (Auth::guest()) ? 2 : Auth::user()->roles->first()->id; // User(2) es el default del guest
            $state_id   = $service->state()->id;
            $state_name = '';
            $role       = Role::where('id', $role_id)->first();

            if($role->canViewState($state_id)){
                $state_name = $service->state()->name;
            }else{
                $service_history = $service->history();

                foreach($service_history as $incidence){
                    if($incidence->id_state != null){
                        if($role->canViewState($incidence->id_state)){
                            $state      = State::where('id', $incidence->id_state)->first();
                            $state_name = $state->name;
                            break;
                        }
                    }
                }
            }

            if($state_name != ''){
                $return = [
                    'id'        => $service->id,
                    'date_in'   => $service->dateInToString(true),
                    'state'     => $state_name,
                ];

                $status = 200;
            }
        }

        return Response::json($return, $status);
    }

    /**
     * Display the specified resource's history.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getHistory(Request $request){
        $this->validate($request, [
            'id' => 'required|min:1'
        ]);

        $id_service = $request->get('id');
        $service    = Service::findOrFail($id_service);
        $history    = $service->history();
        $role       = Role::where('id', Auth::user()->roles->first()->id)->first();

        return view('service.history', compact(['service', 'history', 'role']));
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

        $id_service     = $request->get('id');
        $service        = Service::findOrFail($id_service);
        $states         = State::pluck('name', 'id');
        $users          = User::all(['name', 'id']);
        $cas_users      = [];
        $clients        = Client::all(['company', 'id']);
        $categories     = Category::all(['category', 'id']);
        $brands         = Brand::all(['brand', 'id']);
        $models         = PartModel::all(['part_model', 'id']);
        $selling_houses = SellingHouse::all(['business_name', 'id']);
        $warranties     = Warranty::all(['num_warranty', 'id']);

        foreach($users as $user){
            if($user->getUserRoleId() == env('CAS_USER')) $cas_users[] = $user;
        }

        return view('service.edit', compact(['service', 'states', 'cas_users', 'clients', 'categories', 'brands', 'models', 'selling_houses', 'warranties']));
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
            'id'                    => 'required|min:1',
            'id_state'              => 'required|min:1',
            'id_user'               => 'required|min:1',
            'purchase_order_num'    => 'required|min:1'
        ]);

        $user = Auth::user();
        if($user->hasRole('Admin') || $user->hasRole('Call') || $user->hasRole('CAS')) {
            $edited_fields                          = [];
            $id_service                             = $request->get('id');
            $service                                = Service::findOrFail($id_service);

            $old_id_state                           = $service->id_state;
            $old_id_user                            = $service->id_user;
            $old_id_client                          = $service->id_client;
            $old_id_category                        = $service->id_category;
            $old_id_brand                           = $service->id_brand;
            $old_id_model                           = $service->id_model;
            $old_id_selling_house                   = $service->id_selling_house;
            $old_id_warranty                        = $service->id_warranty;
            $old_purchase_order_num                 = $service->purchase_order_num;
            $old_serial_chasis                      = $service->serial_chasis;
            $old_date_in                            = $service->date_in;
            $old_date_out                           = $service->date_out;
            $old_date_commitment                    = $service->date_commitment;
            $old_defect_according_to_client         = $service->defect_according_to_client;
            $old_equipment_type                     = $service->equipment_type;
            $old_location                           = $service->location;
            $old_warranty                           = $service->warranty;
            $old_stock_reposition_doa               = $service->stock_reposition_doa;
            $old_pending_budget                     = $service->pending_budget;
            $old_home_service                       = $service->home_service;
            $old_stock_repair                       = $service->stock_repair;
            $old_corrective_maintenance             = $service->corrective_maintenance;
            $old_pre_aproved_budget                 = $service->pre_aproved_budget;
            $old_recolection_service                = $service->recolection_service;
            $old_preventive_maintenance             = $service->preventive_maintenance;
            $old_notes                              = $service->notes;

            $service->id_state                      = $request->get('id_state');
            $service->id_user                       = $request->get('id_user');
            $service->id_client                     = $request->get('id_client');
            $service->id_category                   = $request->get('id_category');
            $service->id_brand                      = $request->get('id_brand');
            $service->id_model                      = $request->get('id_model');
            $service->id_selling_house              = $request->get('id_selling_house');
            $service->id_warranty                   = $request->get('id_warranty');
            $service->purchase_order_num            = $request->get('purchase_order_num');
            $service->serial_chasis                 = $request->get('serial_chasis');

            $date_in                                = $request->get('date_in');
            if(!empty($date_in)){
                $date_in            = explode('-', $date_in);
                $service->date_in   = $date_in[2].'-'.$date_in[1].'-'.$date_in[0].' 00:00:00';
            }else{
                $service->date_in = '1970-01-01 00:00:00';
            }

            $date_out                               = $request->get('date_out');
            if(!empty($date_out)){
                $date_out           = explode('-', $date_out);
                $service->date_out  = $date_out[2].'-'.$date_out[1].'-'.$date_out[0].' 00:00:00';
            }else{
                $service->date_out = '1970-01-01 00:00:00';
            }

            $date_commitment                        = $request->get('date_commitment');
            if(!empty($date_commitment)){
                $date_commitment            = explode('-', $date_commitment);
                $service->date_commitment   = $date_commitment[2].'-'.$date_commitment[1].'-'.$date_commitment[0].' 00:00:00';
            }else{
                $service->date_commitment = '1970-01-01 00:00:00';
            }

            $service->defect_according_to_client    = $request->get('defect_according_to_client');
            $service->equipment_type                = $request->get('equipment_type');
            $service->location                      = $request->get('location');
            $service->warranty                      = $request->get('warranty');
            $service->stock_reposition_doa          = $request->get('stock_reposition_doa');
            $service->pending_budget                = $request->get('pending_budget');
            $service->home_service                  = $request->get('home_service');
            $service->stock_repair                  = $request->get('stock_repair');
            $service->corrective_maintenance        = $request->get('corrective_maintenance');
            $service->pre_aproved_budget            = $request->get('pre_aproved_budget');
            $service->recolection_service           = $request->get('recolection_service');
            $service->preventive_maintenance        = $request->get('preventive_maintenance');
            $service->notes                         = $request->get('notes');
            $service->save();

            if($service->id_user                    != $old_id_user)                    $edited_fields[]    = 'usuario';
            if($service->id_client                  != $old_id_client)                  $edited_fields[]    = 'cliente';
            if($service->id_category                != $old_id_category)                $edited_fields[]    = 'categoría';
            if($service->id_brand                   != $old_id_brand)                   $edited_fields[]    = 'marca';
            if($service->id_model                   != $old_id_model)                   $edited_fields[]    = 'modelo';
            if($service->id_selling_house           != $old_id_selling_house)           $edited_fields[]    = 'casa vendedora';
            if($service->id_warranty                != $old_id_warranty)                $edited_fields[]    = 'garantía';
            if($service->purchase_order_num         != $old_purchase_order_num)         $edited_fields[]    = 'número de orden de compra';
            if($service->serial_chasis              != $old_serial_chasis)              $edited_fields[]    = 'chasis-serial';
            if($service->date_in                    != $old_date_in)                    $edited_fields[]    = 'fecha entrada';
            if($service->date_out                   != $old_date_out)                   $edited_fields[]    = 'fecha salida';
            if($service->date_commitment            != $old_date_commitment)            $edited_fields[]    = 'fecha compromiso';
            if($service->defect_according_to_client != $old_defect_according_to_client) $edited_fields[]    = 'defecto según cliente';
            if($service->equipment_type             != $old_equipment_type)             $edited_fields[]    = 'tipo de equipo';
            if($service->location                   != $old_location)                   $edited_fields[]    = 'ubicación';
            if($service->warranty                   != $old_warranty)                   $edited_fields[]    = 'garantía';
            if($service->stock_reposition_doa       != $old_stock_reposition_doa)       $edited_fields[]    = 'reposición de stock (DOA)';
            if($service->pending_budget             != $old_pending_budget)             $edited_fields[]    = 'a presupuestar';
            if($service->home_service               != $old_home_service)               $edited_fields[]    = 'servicio a domicilio';
            if($service->stock_repair               != $old_stock_repair)               $edited_fields[]    = 'reparación de stock';
            if($service->corrective_maintenance     != $old_corrective_maintenance)     $edited_fields[]    = 'mantenimiento correctivo';
            if($service->pre_aproved_budget         != $old_pre_aproved_budget)         $edited_fields[]    = 'presupuesto pre aprobado';
            if($service->recolection_service        != $old_recolection_service)        $edited_fields[]    = 'servicio de recolección';
            if($service->preventive_maintenance     != $old_preventive_maintenance)     $edited_fields[]    = 'mantenimiento preventivo';
            if($service->notes                      != $old_notes)                      $edited_fields[]    = 'notas';

            $serviceHistory                         = new ServiceHistory();
            $new_state                              = ($service->id_state != $old_id_state) ? $service->id_state : null;
            $serviceHistory->id_service             = $id_service;
            $serviceHistory->id_user                = $user->id;
            $serviceHistory->id_state               = $new_state;
            $serviceHistory->edited_fields          = (!empty($edited_fields)) ? implode('|', $edited_fields) : null;
            $serviceHistory->save();

            //Send email if state was changed and there are subscribers
            if($new_state != null) $this->sendEmail($service);

            flash()->success('El Ticket ha sido actualizado.');
        }else{

        }

        return redirect()->route('services.index');
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

        $id = $request->get('id');
        $me = Auth::user();

        if( $me->hasRole('Admin') ) {
            $service = Service::findOrFail($id);
        } else {
            $service = $me->services()->findOrFail($id);
        }

        $service->delete();

        flash()->success('El Ticket ha sido borrado.');

        return redirect()->route('services.index');
    }

    private function sendEmail(Service $service){
        if($state = State::findOrFail($service->id_state)){
            $state_sends_email = $state->sendsMail()->get();
            if(!empty($state_sends_email)){
                $role_names = [];
                foreach($state_sends_email as $state_sends_email_row){
                    if($role = Role::findOrFail($state_sends_email_row->pivot->role_id)){
                        if($role->default_email != null){
                            $result         = Mail::to($role->default_email)->queue(new ServiceStateChanged($service, $state));

                            /*$result         = Mail::send('emails.serviceStateChanged.blade', $data, function($message){
                                $message->from('noreply@mydomain.com', 'My Website');
                                $message->to($role->default_email)->subject(env(''));
                            });*/


                            /*$fail           = Mail::failures();
                            if(!empty($fail)) throw new \Exception('Could not send message to '.$fail[0]);
                            if(empty($result)) throw new \Exception('Email could not be sent.');*/

                            $role_names[]   = $role->name;
                        }
                    }
                }
                if(!empty($role_names)) flash()->success('Se envió un mail a los siguientes suscriptores: '.implode(', ', $role_names));
            }
        }
    }
}
