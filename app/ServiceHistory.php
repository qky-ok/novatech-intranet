<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiceHistory extends Model
{
    protected $table = 'services_history';

    /**
     * Get the Service associated with this Service Incidence.
     */
    public function service(){
        return $this->belongsTo('App\Service', 'id_service', 'id')->first();
    }

    /**
     * Get the Sate for the Service Incidence.
     */
    public function state(){
        return $this->hasOne('App\State', 'id', 'id_state')->first();
    }

    /**
     * Get the CAS for the Service Incidence.
     */
    public function cas(){
        return $this->hasOne('App\User', 'id', 'id_user')->first();
    }

    /**
     * Get the formatted edited fields for the Service Incidence.
     */
    public function formattedEditedFields(){
        $edited_fields_raw  = explode('|', $this->edited_fields);
        $edited_fields      = [];

        foreach($edited_fields_raw as $edited_field_raw){
            if($edited_field_raw == 'id_user'){
                $edited_fields[] = 'CAS';
            }else{
                $edited_fields[] = ucfirst($edited_field_raw);
            }
        }

        return implode(', ', $edited_fields);
    }
}
