<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PartImage extends Model{
    protected $table = 'parts_images';

    /**
     * Get the Part for the PartImage.
     */
    public function part()
    {
        return $this->belongsTo('App\Part')->first();
    }
}
