<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PartPart extends Model{
    protected $table = 'parts_parts';

    /**
     * Get the Part for the ModelPart.
     */
    public function part()
    {
        return $this->belongsTo('App\Part')->first();
    }
}
