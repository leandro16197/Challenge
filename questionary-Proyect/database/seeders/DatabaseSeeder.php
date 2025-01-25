<?php

namespace Database\Seeders;

use App\Models\Response;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        //$this->call(ClearQuestionsResponsesSeeder::class); para limpiar en caso de error 
        $this->call(generosSeeder::class);//carga generos
        $this->call(Questions::class);//carga preguntas
        $this->call(Responses::class);//carga respuestas
        $this->call(ImgGeneros::class);//agrega imagenes a los generos
        $this->call(LifePurchaseSeeder::class);//agrega los valores a la tabla de vidas
        $this->call(Max_Vidas_Seeder::class);//agrega el maximo de vidas gratis que puede recuperar
        $this->call(UsersAndVidaRankingSeeder::class);//agrega 10 usuarios aleatorios en users,vidas y ranking
    }
}
