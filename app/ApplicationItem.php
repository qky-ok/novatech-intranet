<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ApplicationItem extends Model{
    protected $table = 'application_item';

    /**
     * Get the Parts for the Application Item.
     */
    public function parts()
    {
        return $this->hasMany('App\Part', 'id_application_item')->get();
    }
}
