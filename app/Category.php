<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model{
    protected $table = 'categories';

    /**
     * Get the Services for the Category.
     */
    public function services()
    {
        return $this->belongsToMany('App\Service', 'services', 'id_category');
    }
}
