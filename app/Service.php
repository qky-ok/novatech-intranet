<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model{
    protected $table = 'services';

    /**
     * Get the Sate for the Service.
     */
    public function state()
    {
        return $this->hasOne('App\State', 'id', 'id_state')->first();
    }

    /**
     * Get the CAS for the Service.
     */
    public function cas()
    {
        return $this->hasOne('App\User', 'id', 'id_user')->first();
    }

    /**
     * Get the Histoy for the Service.
     */
    public function history()
    {
        return $this->hasMany('App\ServiceHistory', 'id_service')->orderBy('created_at', 'desc')->get();
    }
}
