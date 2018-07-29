<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CasServiceStock extends Model
{
    protected $table    = 'cas_service_stock';
    public $timestamps  = false;

    /**
     * Get the Service for the CasServiceStock.
     */
    public function service(){
        return $this->hasOne('App\Service', 'id', 'id_service')->first();
    }
}
