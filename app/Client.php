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

    public function dateToString($safe = false){
        if(($this->date_created === '1970-01-01 00:00:00' || $this->date_created === '' || $this->date_created === null) && $safe){
            return '-';
        }else if($this->date_created === '1970-01-01 00:00:00' || $this->date_created === '' || $this->date_created === null){
            return '';
        }else{
            $timestamp  = explode(' ', $this->date_created);
            $date       = explode('-', $timestamp[0]);
            return $date[2].'-'.$date[1].'-'.$date[0];
        }
    }
}
