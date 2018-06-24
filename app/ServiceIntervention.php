<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiceIntervention extends Model{
    protected $table = 'services_interventions';

    /**
     * Get the Service for the ServiceIntervention.
     */
    public function service()
    {
        return $this->belongsTo('App\Service', 'id_service')->first();
    }

    /**
     * Get the Intervention for the ServiceIntervention.
     */
    public function intervention()
    {
        return $this->belongsTo('App\Intervention', 'id_intervention')->first();
    }
}
