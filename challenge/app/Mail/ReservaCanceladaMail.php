<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReservaCanceladaMail extends Mailable
{
    use Queueable, SerializesModels;

    public $reserva;

    public function __construct($reserva)
    {
        $this->reserva = $reserva;
    }

    public function build()
    {
        return $this->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'))
            ->subject('Reserva Cancelada')
            ->view('emails.reserva_cancelada')
            ->with(['reserva' => $this->reserva]);
    }
}
