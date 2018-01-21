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
     * Get the Warranty for the Service.
     */
    public function warranty()
    {
        return $this->hasOne('App\Warranty', 'id', 'id_warranty')->first();
    }

    /**
     * Get the Client for the Service.
     */
    public function client()
    {
        return $this->hasOne('App\Client', 'id', 'id_client')->first();
    }

    /**
     * Get the Brand for the Service.
     */
    public function brand()
    {
        return $this->hasOne('App\Brand', 'id', 'id_brand')->first();
    }

    /**
     * Get the Model for the Service.
     */
    public function model()
    {
        return $this->hasOne('App\PartModel', 'id', 'id_model')->first();
    }

    /**
     * Get the Category for the Service.
     */
    public function category()
    {
        return $this->hasOne('App\Category', 'id', 'id_category')->first();
    }

    /**
     * Get the Selling House for the Service.
     */
    public function selling_house()
    {
        return $this->hasOne('App\SellingHouse', 'id', 'id_selling_house')->first();
    }

    /**
     * Get the Histoy for the Service.
     */
    public function history()
    {
        return $this->hasMany('App\ServiceHistory', 'id_service')->orderBy('created_at', 'desc')->get();
    }
}
