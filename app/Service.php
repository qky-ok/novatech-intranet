<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model{
    protected $table = 'services';

    /**
     * Get the Sate for the Service.
     */
    public function state()
    {
        return $this->hasOne('App\State', 'id', 'id_state')->first();
    }

    /**
     * Get the CAS for the Service.
     */
    public function cas()
    {
        return $this->hasOne('App\User', 'id', 'id_user')->first();
    }

    /**
     * Get the Brand for the Service.
     */
    public function part()
    {
        return $this->hasOne('App\Part', 'id', 'id_part')->first();
    }

    /**
     * Get the Warranty for the Service.
     */
    public function warranty()
    {
        return $this->hasOne('App\Warranty', 'id', 'id_warranty')->first();
    }

    /**
     * Get the Client for the Service.
     */
    public function client()
    {
        return $this->hasOne('App\Client', 'id', 'id_client')->first();
    }

    /**
     * Get the Brand for the Service.
     */
    public function brand()
    {
        return $this->hasOne('App\Brand', 'id', 'id_brand')->first();
    }

    /**
     * Get the Model for the Service.
     */
    public function model()
    {
        return $this->hasOne('App\PartModel', 'id', 'id_model')->first();
    }

    /**
     * Get the Category for the Service.
     */
    public function category()
    {
        return $this->hasOne('App\Category', 'id', 'id_category')->first();
    }

    /**
     * Get the Selling House for the Service.
     */
    public function selling_house()
    {
        return $this->hasOne('App\SellingHouse', 'id', 'id_selling_house')->first();
    }

    /**
     * Get the Histoy for the Service.
     */
    public function history()
    {
        return $this->hasMany('App\ServiceHistory', 'id_service')->orderBy('created_at', 'desc')->get();
    }

    public function dateInToString($safe = false){
        if(($this->date_in === '1970-01-01 00:00:00' || $this->date_in === '' || $this->date_in === null) && $safe){
            return '-';
        }else if($this->date_in === '1970-01-01 00:00:00' || $this->date_in === '' || $this->date_in === null){
            return '';
        }else{
            $timestamp  = explode(' ', $this->date_in);
            $date       = explode('-', $timestamp[0]);
            return $date[2].'-'.$date[1].'-'.$date[0];
        }
    }

    public function dateOutToString($safe = false){
        if(($this->date_out === '1970-01-01 00:00:00' || $this->date_out === '' || $this->date_out === null) && $safe){
            return '-';
        }else if($this->date_out === '1970-01-01 00:00:00' || $this->date_out === ''){
            return '';
        }else{
            $timestamp  = explode(' ', $this->date_out);
            $date       = explode('-', $timestamp[0]);
            return $date[2].'-'.$date[1].'-'.$date[0];
        }
    }

    public function dateCommitmentToString($safe = false){
        if(($this->date_commitment === '1970-01-01 00:00:00' || $this->date_commitment === '' || $this->date_commitment === null) && $safe){
            return '-';
        }else if($this->date_commitment === '1970-01-01 00:00:00' || $this->date_commitment === ''){
            return '';
        }else{
            $timestamp  = explode(' ', $this->date_commitment);
            $date       = explode('-', $timestamp[0]);
            return $date[2].'-'.$date[1].'-'.$date[0];
        }
    }

    public function alarmCheck(){
        $has_alarm = (object) [];

        if(($this->date_commitment !== '1970-01-01 00:00:00' && $this->date_commitment !== '') && ($this->date_out === '1970-01-01 00:00:00' || $this->date_out === '')){
            $alarms             = ServiceAlarm::all();
            $commitment_date    = date_create($this->date_commitment);
            $today 	            = date_create();
            $diff  	            = date_diff($today, $commitment_date);

            if(!empty($alarms)){
                foreach($alarms as $alarm){
                    $alarm_days = $alarm->alarm_days;
                    if($diff->days <= $alarm_days) $has_alarm = (object) ['name' => $alarm->alarm_name, 'days' => $diff->days];
                }
            }
        }

        return $has_alarm;
    }
}
