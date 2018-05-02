<?php

namespace App\Mail;

use App\Service;
use App\State;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ServiceAlarmMail extends Mailable{
    use Queueable, SerializesModels;

    public $mailBody;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($mailBody){
        $this->mailBody = $mailBody;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(){
        return  $this->view('emails.serviceAlarmMail')
                ->from(env('MAIL_FROM_ADDRESS'))
                ->subject('Service - Alarma')
                ->with([
                    'body'  => $this->mailBody
                ]);
    }
}
