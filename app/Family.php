<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Family extends Model{
    protected $table = 'families';

    /**
     * Get the Parent for the Family.
     */
    public function parent()
    {
        return $this->belongsTo(self::class, 'id_parent');
    }

    /**
     * Get the Part for the Family.
     */
    public function family_parts()
    {
        return $this->belongsToMany('App\Family', 'parts', 'id_family')->get();
    }

    /**
     * Get the Part for the Sub Family.
     */
    public function sub_family_parts()
    {
        return $this->belongsToMany('App\Family', 'parts', 'id_sub_family')->get();
    }
}
