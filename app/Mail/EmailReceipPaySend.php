<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class EmailReceipPaySend extends Mailable
{
    use Queueable, SerializesModels;

    public $edata;      // Datos de correo y cabecera
    public $movto;    // Datos de movimiento

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($edata, $movto)
    {
        $this->edata = $edata;
        $this->movto = $movto;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        //dd($this->movto);        
        return $this->from($this->edata->sfrom, $this->edata->sname)
            ->subject($this->edata->subj)
            ->view('emails.movs.receippay')
            ->text('emails.movs.receippayplain')          
            ->attach($this->edata->satach, 
                [
                  'as' => $this->edata->sfilename,
                  'mime' => $this->edata->smimetype
                ]);
    }
}
