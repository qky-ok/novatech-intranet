<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Part extends Model{
    protected $table = 'parts';

    /**
     * Get the Application for the Part.
     */
    public function application_item()
    {
        return $this->hasOne('App\ApplicationItem', 'id', 'id_application_item')->first();
    }

    /**
     * Get the Brand for the Part.
     */
    public function brand()
    {
        return $this->hasOne('App\Brand', 'id', 'id_brand')->first();
    }

    /**
     * Get the Models for the Part.
     */
    public function models()
    {
        return $this->belongsToMany('App\PartModel', 'model_part', 'part_id', 'model_id');
    }

    /**
     * Get the Family for the Part.
     */
    public function family()
    {
        return $this->hasOne('App\Family', 'id', 'id_family')->first();
    }

    /**
     * Get the Sub Family for the Part.
     */
    public function sub_family()
    {
        return $this->hasOne('App\Family', 'id', 'id_sub_family')->first();
    }

    /**
     * Get the Replacement for the Part.
     */
    public function replacement()
    {
        return $this->belongsTo('App\Part', 'id_replacement_part')->first();
    }

    /**
     * Get the Provider for the Part.
     */
    public function provider()
    {
        return $this->hasOne('App\Provider', 'id', 'id_provider')->first();
    }

    /**
     * Get the PartImages for the Part.
     */
    public function images()
    {
        return $this->hasMany('App\PartImage', 'id_part')->get();
    }
}
