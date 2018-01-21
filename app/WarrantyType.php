<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WarrantyType extends Model{
    protected $table = 'warranty_types';

    /**
     * Get the Warranties for the Warranty Type.
     */
    public function warranties()
    {
        return $this->belongsToMany('App\Service', 'warranties', 'id_warranty_type');
    }
}
