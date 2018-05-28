<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModelPart extends Model{
    protected $table = 'models_parts';

    /**
     * Get the Model for the ModelPart.
     */
    public function model()
    {
        return $this->belongsTo('App\PartModel', 'id_model')->first();
    }

    /**
     * Get the Part for the ModelPart.
     */
    public function part()
    {
        return $this->belongsTo('App\Part', 'id_part')->first();
    }
}
