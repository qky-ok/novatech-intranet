<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model{
    protected $table = 'brands';

    /**
     * Get the Services for the Brand.
     */
    public function services()
    {
        return $this->belongsToMany('App\Service', 'services', 'id_brand');
    }

    /**
     * Get the Models for the Brand.
     */
    public function models()
    {
        return $this->hasMany('App\PartModel', 'id_brand')->get();
    }
}
