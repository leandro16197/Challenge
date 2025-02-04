<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EventoActualizadoMail extends Mailable
{
    use Queueable, SerializesModels;

    public $evento;

    public function __construct($evento)
    {
        $this->evento = $evento;
    }

    public function build()
    {
        return $this->subject('¡El evento ha sido actualizado!')
                    ->view('emails.evento_actualizado')
                    ->with(['evento' => $this->evento]);
    }
}