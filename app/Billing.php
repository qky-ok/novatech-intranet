<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Billing extends Model{
    protected $table = 'billings';

    public function dateToString($safe = false){
        if(($this->billing_date === '1970-01-01 00:00:00' || $this->billing_date === '' || $this->billing_date === null) && $safe){
            return '-';
        }else if($this->billing_date === '1970-01-01 00:00:00' || $this->billing_date === '' || $this->billing_date === null){
            return '';
        }else{
            $timestamp  = explode(' ', $this->billing_date);
            $date       = explode('-', $timestamp[0]);
            return $date[2].'-'.$date[1].'-'.$date[0];
        }
    }

    public function state(){
        $id_state   = $this->id_state;
        $state      = '';

        switch($id_state){
            case 1:
                $state = 'Enviada';
            break;
            case 2:
                $state = 'En proceso';
            break;
            case 3:
                $state = 'Pagada';
            break;
        }

        return $state;
    }

    public function total(){
        $billing_services   = BillingService::where('id_billing', $this->id)->get();
        $total              = 0;

        if(!empty($billing_services)){
            foreach($billing_services as $billing_service){
                $total += $billing_service->amount;
            }
        }

        return $total;
    }
}
