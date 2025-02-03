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
                'capacidad_maxima' => 500,
                'localidad' => 'Buenos Aires',
                'direccion' => 'Av. Corrientes 1234, CABA',
            ],
            [
                'nombre' => 'Festival de Jazz',
                'description' => 'Un festival de jazz con músicos de renombre mundial.',
                'fecha_evento' => Carbon::parse('2025-04-02 19:00:00'),
                'capacidad_maxima' => 300,
                'localidad' => 'Buenos Aires',
                'direccion' => 'Teatro Colón, CABA',
            ],
            [
                'nombre' => 'Exposición de Arte Contemporáneo',
                'description' => 'Una exposición que muestra lo mejor del arte moderno y contemporáneo.',
                'fecha_evento' => Carbon::parse('2025-05-10 10:00:00'),
                'capacidad_maxima' => 1000,
                'localidad' => 'CABA',
                'direccion' => 'Museo de Arte Moderno, CABA',
            ],
            [
                'nombre' => 'Feria de Tecnología',
                'description' => 'Un evento para explorar lo último en innovación tecnológica.',
                'fecha_evento' => Carbon::parse('2025-06-05 09:00:00'),
                'capacidad_maxima' => 5000,
                'localidad' => 'Buenos Aires',
                'direccion' => 'La Rural, CABA',
            ],
            [
                'nombre' => 'Carrera de Autos',
                'description' => 'Una emocionante carrera de autos deportivos de alta velocidad.',
                'fecha_evento' => Carbon::parse('2025-07-20 14:00:00'),
                'capacidad_maxima' => 20000,
                'localidad' => 'Buenos Aires',
                'direccion' => 'Autódromo de Buenos Aires, CABA',
            ],
            [
                'nombre' => 'Festival de Cine Internacional',
                'description' => 'Proyecciones de películas internacionales premiadas.',
                'fecha_evento' => Carbon::parse('2025-08-15 19:00:00'),
                'capacidad_maxima' => 800,
                'localidad' => 'CABA',
                'direccion' => 'Cine Hoyts, CABA',
            ],
            [
                'nombre' => 'Feria Gastronómica',
                'description' => 'Una feria con los mejores chefs y restaurantes del país.',
                'fecha_evento' => Carbon::parse('2025-09-12 11:00:00'),
                'capacidad_maxima' => 1500,
                'localidad' => 'Buenos Aires',
                'direccion' => 'Plaza Mayor, CABA',
            ],
            [
                'nombre' => 'Concierto de Música Clásica',
                'description' => 'Una noche de música clásica interpretada por una orquesta sinfónica.',
                'fecha_evento' => Carbon::parse('2025-10-01 20:00:00'),
                'capacidad_maxima' => 1200,
                'localidad' => 'Buenos Aires',
                'direccion' => 'Teatro Colón, CABA',
            ],
            [
                'nombre' => 'Torneo de Fútbol',
                'description' => 'Un emocionante torneo de fútbol con equipos locales.',
                'fecha_evento' => Carbon::parse('2025-11-25 15:00:00'),
                'capacidad_maxima' => 25000,
                'localidad' => 'Buenos Aires',
                'direccion' => 'Estadio Monumental, CABA',
            ],
            [
                'nombre' => 'Exposición de Automóviles',
                'description' => 'Una muestra de los autos más nuevos y espectaculares del mercado.',
                'fecha_evento' => Carbon::parse('2025-12-10 10:00:00'),
                'capacidad_maxima' => 3000,
                'localidad' => 'Buenos Aires',
                'direccion' => 'Centro de Exposiciones, CABA',
            ],
            [
                'nombre' => 'Ciclo de Conferencias de Marketing Digital',
                'description' => 'Conferencias sobre las últimas tendencias en marketing digital.',
                'fecha_evento' => Carbon::parse('2025-03-18 09:00:00'),
                'capacidad_maxima' => 600,
                'localidad' => 'Buenos Aires',
                'direccion' => 'Hotel Panamericano, CABA',
            ],
            [
                'nombre' => 'Fiesta de Año Nuevo',
                'description' => 'Celebración de Año Nuevo con música, comida y fuegos artificiales.',
                'fecha_evento' => Carbon::parse('2025-12-31 23:00:00'),
                'capacidad_maxima' => 1000,
                'localidad' => 'CABA',
                'direccion' => 'Espacio 2000, CABA',
            ],
            [
                'nombre' => 'Encuentro de Fotografía',
                'description' => 'Una jornada para compartir y aprender sobre fotografía profesional.',
                'fecha_evento' => Carbon::parse('2025-05-05 14:00:00'),
                'capacidad_maxima' => 400,
                'localidad' => 'Buenos Aires',
                'direccion' => 'Centro Cultural Borges, CABA',
            ],
            [
                'nombre' => 'Convención de Videojuegos',
                'description' => 'Un evento para los fanáticos de los videojuegos, con charlas y competiciones.',
                'fecha_evento' => Carbon::parse('2025-06-10 10:00:00'),
                'capacidad_maxima' => 3000,
                'localidad' => 'Buenos Aires',
                'direccion' => 'La Rural, CABA',
            ],
            [
                'nombre' => 'Desfile de Moda',
                'description' => 'Los mejores diseñadores y modelos del país se presentan en esta pasarela.',
                'fecha_evento' => Carbon::parse('2025-07-04 19:00:00'),
                'capacidad_maxima' => 500,
                'localidad' => 'Buenos Aires',
                'direccion' => 'Teatro Gran Rex, CABA',
            ],
            [
                'nombre' => 'Conferencia de Tecnología Blockchain',
                'description' => 'Un evento sobre las últimas tendencias en blockchain y criptomonedas.',
                'fecha_evento' => Carbon::parse('2025-09-20 10:00:00'),
                'capacidad_maxima' => 600,
                'localidad' => 'Buenos Aires',
                'direccion' => 'Centro de Convenciones, CABA',
            ],
            [
                'nombre' => 'Fiesta Electrónica',
                'description' => 'Una fiesta electrónica con los mejores DJ nacionales e internacionales.',
                'fecha_evento' => Carbon::parse('2025-10-10 22:00:00'),
                'capacidad_maxima' => 5000,
                'localidad' => 'Buenos Aires',
                'direccion' => 'Club X, CABA',
            ],
            [
                'nombre' => 'Muestra de Fotografía',
                'description' => 'Una exposición de los mejores fotógrafos contemporáneos.',
                'fecha_evento' => Carbon::parse('2025-08-12 11:00:00'),
                'capacidad_maxima' => 300,
                'localidad' => 'Buenos Aires',
                'direccion' => 'Museo de Arte Latinoamericano, CABA',
            ],
            [
                'nombre' => 'Festival de Música Electrónica',
                'description' => 'Un festival de música electrónica con los DJ más reconocidos del mundo.',
                'fecha_evento' => Carbon::parse('2025-11-30 18:00:00'),
                'capacidad_maxima' => 10000,
                'localidad' => 'Buenos Aires',
                'direccion' => 'Campo de Polo, CABA',
            ],
            [
                'nombre' => 'Exposición de Ciencias',
                'description' => 'Un evento educativo para descubrir los últimos avances científicos.',
                'fecha_evento' => Carbon::parse('2025-12-15 09:00:00'),
                'capacidad_maxima' => 1500,
                'localidad' => 'Buenos Aires',
                'direccion' => 'Centro Cultural Kirchner, CABA',
            ]
        ]);
        
    }
}
