<?php

namespace App\Mail;

use App\Models\Reservas;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReservaConfirmacion extends Mailable
{
    use Queueable, SerializesModels;

    public $reserva; // Variable para pasar los datos de la reserva

    /**
     * Crear una nueva instancia de mensaje de correo.
     *
     * @param  \App\Models\Reservas  $reserva
     * @return void
     */
    public function __construct(Reservas $reserva)
    {
        $this->reserva = $reserva;
    }

    /**
     * Construir el mensaje de correo.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Confirmación de Reserva')
                    ->view('emails.reserva_confirmacion'); 
    }
}
