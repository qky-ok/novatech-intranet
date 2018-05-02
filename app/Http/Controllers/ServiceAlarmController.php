<?php

namespace App\Http\Controllers;

use App\ServiceAlarm;
use App\Role;
use App\Service;
use App\Mail\ServiceAlarmMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;

class ServiceAlarmController extends Controller{


    /**
     * Display a listing of the resource.
     */
    public function index(){
        $result = ServiceAlarm::all();
        return view('service_alarm.index', compact('result'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request){
        $this->validate($request, [
            'id' => 'required'
        ]);

        $id             = $request->get('id');
        $service_alarm  = ServiceAlarm::findOrFail($id);
        $roles          = Role::all();
        $alarm_roles    = $service_alarm->roles();

        return view('service_alarm.edit', compact(['service_alarm', 'roles', 'alarm_roles']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request){
        $this->validate($request, [
            'id'            => 'required',
            'alarm_days'    => 'required'
        ]);

        $id             = $request->get('id');
        $service_alarm  = ServiceAlarm::findOrFail($id);
        $alarm_users    = [];

        // Update Service Alarm
        $service_alarm->alarm_days = $request->get('alarm_days');

        if(!empty($request->get('alarm_users'))){
            foreach($request->get('alarm_users') as $id_role){
                if($id_role) $alarm_users[] = $id_role;
            }
        }

        $service_alarm->alarm_users = implode('|', $alarm_users);
        $service_alarm->save();

        flash()->success('La Alarma de Ticket ha sido actualizada.');

        return redirect()->route('service_alarm.index');
    }

    public function checkServices(){
        $services = Service::all();

        if(!empty($services)){
            foreach($services as $service){
                if(isset($service->alarmCheck()->name)){
                    $service_alarm = ServiceAlarm::where('alarm_name', $service->alarmCheck()->name)->first();
                    if($service->alarmCheck()->days === $service_alarm->alarm_days){
                        $this->sendEmail($service, $service_alarm);
                    }else{
                        echo "<br/>Ticket ID: ".$service->id." -> Días faltantes: ".$service->alarmCheck()->days." (".$service_alarm->alarm_name.") -> NO ENVÍA MAIL";
                    }
                }
            }
        }
    }

    private function sendEmail(Service $service, ServiceAlarm $service_alarm){
        if(!empty($service_alarm->roles())){
            $mailBody = "El Ticket ID: ".$service->id." ha entrado en ".$service_alarm->alarm_name;

            echo "<br/>Service: ".$service->id." (Alarm ".$service_alarm->alarm_name.") -> MAILS ENVIADOS<br/>";

            foreach($service_alarm->roles() as $service_alarm_role){
                $role   = Role::findOrFail($service_alarm_role)->first();
                $users  = $role->role_users();

                if(!empty($users)){
                    foreach($users as $user){
                        $user_email = $user->email;
                        echo $user_email.' - ';
                        $mail       = Mail::to($user_email)->queue(new ServiceAlarmMail($mailBody));
                    }
                }
            }
        }
    }
}
