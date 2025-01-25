<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\vidaModel; 
use Carbon\Carbon;

class RecoverLives extends Command
{
    protected $signature = 'lives:recover';

    protected $description = 'Recupera una vida por minuto para los usuarios, hasta el máximo permitido';

    public function handle()
    {
        $vidas = vidaModel::all();
        $now = Carbon::now();

        foreach ($vidas as $vida) {
            $this->info("Revisando vida de usuario ID: {$vida->user_id}, Vidas actuales: {$vida->vidas}");


            if (is_null($vida->last_updated)) {
                $this->info("last_updated es null para el usuario ID: {$vida->user_id}. Actualizando ahora.");
                $vida->last_updated = $now;
                $vida->save();
                continue; 
            }

            if ($vida->vidas < $vida->max_vidas) {
                $lastUpdated = Carbon::parse($vida->last_updated);
                $minutesPassed = $lastUpdated->diffInMinutes($now);

                $this->info("Minutos desde la última actualización: {$minutesPassed}");

                if ($minutesPassed >= 1) {
                    $vidasToAdd = floor($minutesPassed / 1);  
                    $this->info("Vidas que se agregarán: {$vidasToAdd}");

                    $vida->vidas = min($vida->vidas + $vidasToAdd,$vida->max_vidas);  
                    $vida->last_updated = $now;
                    $vida->save();
                    $this->info("Vida actualizada para usuario ID: {$vida->user_id}");
                }
            }
        }

        $this->info('Vidas recuperadas correctamente.');
    }
}
