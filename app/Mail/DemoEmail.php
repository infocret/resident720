<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class DemoEmail extends Mailable
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
        //return $this->view('view.name');
        return $this->from($this->demo->sfrom, $this->demo->sname)
            ->subject($this->demo->subj)
            ->view('emails.demo')
            ->text('emails.demo_plain')
            ->with(
              [
                    'testVarOne' => 'val_var_1',
                    'testVarTwo' => 'val_var_2',
              ])
              ->attach(public_path('/img').'/adplogo_110.png', [
                      'as' => 'adplogo_110.png',
                      'mime' => 'image/png',
              ]);
    }
}
