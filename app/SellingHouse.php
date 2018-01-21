<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SellingHouse extends Model{
    protected $table = 'selling_houses';

    /**
     * Get the Services for the Category.
     */
    public function services()
    {
        return $this->belongsToMany('App\Service', 'services', 'id_selling_house');
    }
}
