<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;

class RendezVousStatutMail extends Mailable
{
    public $rdv;
    public $messageContent;

    public function __construct($rdv, $messageContent)
    {
        $this->rdv = $rdv;
        $this->messageContent = $messageContent;
    }

    public function build()
    {
        return $this->subject('Mise à jour de votre rendez-vous')
                    ->view('emails.rendezvous');
    }
}