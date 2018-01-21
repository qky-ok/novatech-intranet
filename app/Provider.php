<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Provider extends Model{
    protected $table = 'providers';

    /**
     * Get the Parts for the Provider.
     */
    public function parts()
    {
        return $this->belongsToMany('App\Part', 'parts', 'id_provider');
    }
}
