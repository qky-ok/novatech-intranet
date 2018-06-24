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
    public $attachment;
    public $subject;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Service $service, State $state, $attachment, $subject){
        $this->service      = $service;
        $this->state        = $state;
        $this->attachment   = $attachment;
        $this->subject      = $subject;
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
                ->subject($this->subject)
                ->attach($this->attachment)
                ->with([
                    'serviceId'     => $service->id,
                    'serviceState'  => $this->state->name,
                    'serviceCas'    => $cas,
                    'serviceClient' => $client
                ]);
    }
}
