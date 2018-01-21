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
    public function model()
    {
        return $this->belongsToMany('App\PartModel');
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
        return $this->belongsTo(self::class, 'id_replacement_part');
    }

    /**
     * Get the Provider for the Part.
     */
    public function provider()
    {
        return $this->hasOne('App\Provider', 'id', 'id_provider')->first();
    }
}
