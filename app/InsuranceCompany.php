<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InsuranceCompany extends Model{
    protected $table = 'insurance_companies';

    /**
     * Get the Warranties for the Insurance Company.
     */
    public function warranties()
    {
        return $this->belongsToMany('App\Warranty', 'warranties', 'id_insurance_companies');
    }
}
