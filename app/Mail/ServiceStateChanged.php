<?php

namespace App\Mail;

use App\Service;
use App\State;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ServiceStateChanged extends Mailable{
    use Queueable, SerializesModels;

    protected $service;
    protected $state;

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
        return  $this->view('emails.serviceStateChanged')
                ->subject('Service - Cambio de Estado')
                ->with([
                    'serviceId'             => $this->service->id,
                    'serviceState'          => $this->state->name,
                    'serviceTitle'          => $this->service->title,
                    'serviceDescription'    => $this->service->description
                ]);
    }
}
