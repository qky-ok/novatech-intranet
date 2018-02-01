<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Warranty extends Model{
    protected $table = 'warranties';

    /**
     * Get the Service for the Warranty.
     */
    public function service()
    {
        return $this->hasOne('App\Service', 'id_warranty', 'id')->first();
    }

    /**
     * Get the Warranty Type for the Warranty.
     */
    public function warranty_type()
    {
        return $this->hasOne('App\WarrantyType', 'id', 'id_warranty_type')->first();
    }

    public function datePurchaseToString($safe = false){
        if(($this->date_purchase === '1970-01-01 00:00:00' || $this->date_purchase === '' || $this->date_purchase === null) && $safe){
            return '-';
        }else if($this->date_purchase === '1970-01-01 00:00:00' || $this->date_purchase === '' || $this->date_purchase === null){
            return '';
        }else{
            $timestamp  = explode(' ', $this->date_purchase);
            $date       = explode('-', $timestamp[0]);
            return $date[2].'-'.$date[1].'-'.$date[0];
        }
    }

    public function dateFailureToString($safe = false){
        if(($this->date_failure === '1970-01-01 00:00:00' || $this->date_failure === '' || $this->date_failure === null) && $safe){
            return '-';
        }else if($this->date_failure === '1970-01-01 00:00:00' || $this->date_failure === '' || $this->date_failure === null){
            return '';
        }else{
            $timestamp  = explode(' ', $this->date_failure);
            $date       = explode('-', $timestamp[0]);
            return $date[2].'-'.$date[1].'-'.$date[0];
        }
    }

    public function dateFabricationToString($safe = false){
        if(($this->date_fabrication === '1970-01-01 00:00:00' || $this->date_fabrication === '' || $this->date_fabrication === null) && $safe){
            return '-';
        }else if($this->date_fabrication === '1970-01-01 00:00:00' || $this->date_fabrication === '' || $this->date_fabrication === null){
            return '';
        }else{
            $timestamp  = explode(' ', $this->date_fabrication);
            $date       = explode('-', $timestamp[0]);
            return $date[2].'-'.$date[1].'-'.$date[0];
        }
    }

    public function dateInsuranceExpirationToString($safe = false){
        if(($this->date_insurance_expiration === '1970-01-01 00:00:00' || $this->date_insurance_expiration === '' || $this->date_insurance_expiration === null) && $safe){
            return '-';
        }else if($this->date_insurance_expiration === '1970-01-01 00:00:00' || $this->date_insurance_expiration === '' || $this->date_insurance_expiration === null){
            return '';
        }else{
            $timestamp  = explode(' ', $this->date_insurance_expiration);
            $date       = explode('-', $timestamp[0]);
            return $date[2].'-'.$date[1].'-'.$date[0];
        }
    }
}
