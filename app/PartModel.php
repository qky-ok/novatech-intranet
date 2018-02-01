<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PartModel extends Model{
    protected $table = 'models';

    /**
     * Get the Part for the Model.
     */
    public function parts()
    {
        return $this->belongsToMany('App\Part', 'model_part', 'model_id', 'part_id');
    }

    /**
     * Get the Brand for the Model.
     */
    public function brand()
    {
        return $this->hasOne('App\Brand', 'id', 'id_brand')->first();
    }
}
