<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model{
    protected $table = 'clients';

    /**
     * Get the Services for the Client.
     */
    public function service()
    {
        return $this->hasMany('App\Service', 'id_client')->orderBy('created_at', 'desc')->get();
    }
}
