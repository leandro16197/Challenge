<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class EventoSeeder extends Seeder
{
    public function run()
    {
        DB::table('evento')->insert([
            [
                'nombre' => 'Concierto de Rock',
                'description' => 'Un concierto de rock con bandas locales e internacionales.',
                'fecha_evento' => Carbon::parse('2025-03-15 20:00:00'),
                'capacidad_maxima' => 5,
                'localidad' => 'Buenos Aires',
                'direccion' => 'Av. Corrientes 1234, CABA',
            ],
            [
                'nombre' => 'Feria de Comida',
                'description' => 'Una feria gastronómica con una gran variedad de platos locales e internacionales.',
                'fecha_evento' => Carbon::parse('2025-04-10 12:00:00'),
                'capacidad_maxima' => 3,
                'localidad' => 'Buenos Aires',
                'direccion' => 'Av. 9 de Julio 1500, CABA',
            ],
            [
                'nombre' => 'Exposición de Arte',
                'description' => 'Una exposición de arte moderno con trabajos de artistas emergentes.',
                'fecha_evento' => Carbon::parse('2025-05-05 09:00:00'),
                'capacidad_maxima' => 1,
                'localidad' => 'Rosario',
                'direccion' => 'Pje. El Carmen 101, Rosario',
            ],
            [
                'nombre' => 'Festival de Cine',
                'description' => 'Un festival de cine con proyecciones de películas independientes.',
                'fecha_evento' => Carbon::parse('2025-06-20 18:00:00'),
                'capacidad_maxima' => 2,
                'localidad' => 'Córdoba',
                'direccion' => 'Calle 27 de Abril 450, Córdoba',
            ],
            [
                'nombre' => 'Conferencia de Tecnología',
                'description' => 'Una conferencia sobre las últimas tendencias en tecnología y desarrollo de software.',
                'fecha_evento' => Carbon::parse('2025-07-25 10:00:00'),
                'capacidad_maxima' => 10,
                'localidad' => 'Mendoza',
                'direccion' => 'Calle Belgrano 1122, Mendoza',
            ]
        ]);
        
    }
}
