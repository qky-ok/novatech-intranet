<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PartModel extends Model{
    protected $table = 'models';

    /**
     * Get the Part for the Model.
     */
    public function part()
    {
        return $this->belongsToMany('App\Part');
    }

    /**
     * Get the Brand for the Model.
     */
    public function brand()
    {
        return $this->hasOne('App\Brand', 'id', 'id_brand')->first();
    }
}
