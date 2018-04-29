<?php

namespace App\Mail;

use App\Service;
use App\State;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ServiceStateChanged extends Mailable{
    use Queueable, SerializesModels;

    public $service;
    public $state;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Service $service, State $state){
        $this->service  = $service;
        $this->state    = $state;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(){
        $service    = Service::findOrFail($this->service->id);
        $cas        = (!empty($service->cas()))     ? $service->cas()->name             : ' - ';
        $client     = (!empty($service->client()))  ? $service->client()->business_name : ' - ';

        return  $this->view('emails.serviceStateChanged')
                ->from(env('MAIL_FROM_ADDRESS'))
                ->subject('Service - Cambio de Estado')
                ->with([
                    'serviceId'     => $service->id,
                    'serviceState'  => $this->state->name,
                    'serviceCas'    => $cas,
                    'serviceClient' => $client
                ]);
    }
}
