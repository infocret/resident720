<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class EmailRecipSend extends Mailable
{
    use Queueable, SerializesModels;

    public $edata;      // Datos de correo y cabecera
    public $details;    // Datos de detalle (coleccion)

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($edata, $details)
    {
        $this->edata = $edata;
        $this->details = $details;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        //dd($this->details);        
        return $this->from($this->edata->sfrom, $this->edata->sname)
            ->subject($this->edata->subj)
            ->view('emails.movs.recipedocta')
            ->text('emails.movs.recipedoctaplain')          
            ->attach($this->edata->satach, 
                [
                  'as' => $this->edata->sfilename,
                  'mime' => $this->edata->smimetype
                ]);
    }
}
