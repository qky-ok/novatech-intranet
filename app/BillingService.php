<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BillingService extends Model{
    protected $table = 'billings_services';

    /**
     * Get the Bill for the BillingService.
     */
    public function bill()
    {
        return $this->belongsTo('App\Billing', 'id_billing')->first();
    }

    /**
     * Get the Service for the BillingService.
     */
    public function service()
    {
        return $this->belongsTo('App\Service', 'id_service')->first();
    }
}
