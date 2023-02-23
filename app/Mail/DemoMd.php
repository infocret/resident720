<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class DemoMd extends Mailable
{
    use Queueable, SerializesModels;
    
    public $demo;   // Variable u objeto que recibe los datos dinamicos del correo
    
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($demo)
    {
         $this->demo = $demo;         
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        //dd($this);
        //dd($this->demo->sfrom);
        return $this->from($this->demo->sfrom, $this->demo->sname)
        ->subject($this->demo->subj)        
        ->markdown('emails.demomd.demo3');
    }
}

