<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Warranty extends Model{
    protected $table = 'warranties';

    /**
     * Get the Service for the Warranty.
     */
    public function service()
    {
        return $this->hasOne('App\Service', 'id_warranty', 'id')->first();
    }

    /**
     * Get the Warranty Type for the Warranty.
     */
    public function warranty_type()
    {
        return $this->hasOne('App\WarrantyType', 'id', 'id_warranty_type')->first();
    }
}
