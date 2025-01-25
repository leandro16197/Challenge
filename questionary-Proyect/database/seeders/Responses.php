<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class Responses extends Seeder
{
    public function run()
    {
        DB::table('responses')->insert([
            // Pregunta 1
            ['question_id' => 1, 'response' => 'Leonardo da Vinci', 'is_correct' => 1],
            ['question_id' => 1, 'response' => 'Pablo Picasso', 'is_correct' => 0],
            ['question_id' => 1, 'response' => 'Vincent van Gogh', 'is_correct' => 0],
            ['question_id' => 1, 'response' => 'Claude Monet', 'is_correct' => 0],
            ['question_id' => 1, 'response' => 'Rembrandt', 'is_correct' => 0],

            // Pregunta 2
            ['question_id' => 2, 'response' => '1945', 'is_correct' => 1],
            ['question_id' => 2, 'response' => '1939', 'is_correct' => 0],
            ['question_id' => 2, 'response' => '1940', 'is_correct' => 0],
            ['question_id' => 2, 'response' => '1918', 'is_correct' => 0],
            ['question_id' => 2, 'response' => '1950', 'is_correct' => 0],

            // Pregunta 3
            ['question_id' => 3, 'response' => '100', 'is_correct' => 0],
            ['question_id' => 3, 'response' => '56', 'is_correct' => 1],
            ['question_id' => 3, 'response' => '49', 'is_correct' => 0],
            ['question_id' => 3, 'response' => '32', 'is_correct' => 0],
            ['question_id' => 3, 'response' => '63', 'is_correct' => 0],

            // Pregunta 4
            ['question_id' => 4, 'response' => 'Miguel de Cervantes', 'is_correct' => 1],
            ['question_id' => 4, 'response' => 'William Shakespeare', 'is_correct' => 0],
            ['question_id' => 4, 'response' => 'Gabriel García Márquez', 'is_correct' => 0],
            ['question_id' => 4, 'response' => 'Mario Vargas Llosa', 'is_correct' => 0],
            ['question_id' => 4, 'response' => 'Edgar Allan Poe', 'is_correct' => 0],

            // Pregunta 5
            ['question_id' => 5, 'response' => 'Hígado', 'is_correct' => 0],
            ['question_id' => 5, 'response' => 'Páncreas', 'is_correct' => 1],
            ['question_id' => 5, 'response' => 'Riñón', 'is_correct' => 0],
            ['question_id' => 5, 'response' => 'Estómago', 'is_correct' => 0],
            ['question_id' => 5, 'response' => 'Corazón', 'is_correct' => 0],

            // Pregunta 6
            ['question_id' => 6, 'response' => 'George Washington', 'is_correct' => 1],
            ['question_id' => 6, 'response' => 'Abraham Lincoln', 'is_correct' => 0],
            ['question_id' => 6, 'response' => 'Thomas Jefferson', 'is_correct' => 0],
            ['question_id' => 6, 'response' => 'Franklin Pierce', 'is_correct' => 0],
            ['question_id' => 6, 'response' => 'John Adams', 'is_correct' => 0],

            // Pregunta 7
            ['question_id' => 7, 'response' => 'Tokio', 'is_correct' => 1],
            ['question_id' => 7, 'response' => 'Osaka', 'is_correct' => 0],
            ['question_id' => 7, 'response' => 'Kyoto', 'is_correct' => 0],
            ['question_id' => 7, 'response' => 'Hiroshima', 'is_correct' => 0],
            ['question_id' => 7, 'response' => 'Nagoya', 'is_correct' => 0],

            // Pregunta 8
            ['question_id' => 8, 'response' => 'Pablo Picasso', 'is_correct' => 1],
            ['question_id' => 8, 'response' => 'Salvador Dalí', 'is_correct' => 0],
            ['question_id' => 8, 'response' => 'Claude Monet', 'is_correct' => 0],
            ['question_id' => 8, 'response' => 'Vincent van Gogh', 'is_correct' => 0],
            ['question_id' => 8, 'response' => 'Joan Miró', 'is_correct' => 0],

            // Pregunta 9
            ['question_id' => 9, 'response' => 'César Augusto', 'is_correct' => 1],
            ['question_id' => 9, 'response' => 'Marco Aurelio', 'is_correct' => 0],
            ['question_id' => 9, 'response' => 'Julio César', 'is_correct' => 0],
            ['question_id' => 9, 'response' => 'Nerón', 'is_correct' => 0],
            ['question_id' => 9, 'response' => 'Tiberio', 'is_correct' => 0],

            // Pregunta 10
            ['question_id' => 10, 'response' => 'π * r^2', 'is_correct' => 1],
            ['question_id' => 10, 'response' => '2 * π * r', 'is_correct' => 0],
            ['question_id' => 10, 'response' => 'π * d', 'is_correct' => 0],
            ['question_id' => 10, 'response' => '4 * π * r^2', 'is_correct' => 0],
            ['question_id' => 10, 'response' => 'π * r^3', 'is_correct' => 0],

            // Pregunta 11
            ['question_id' => 11, 'response' => 'Gabriel García Márquez', 'is_correct' => 0],
            ['question_id' => 11, 'response' => 'Mario Vargas Llosa', 'is_correct' => 0],
            ['question_id' => 11, 'response' => 'Juan Rulfo', 'is_correct' => 0],
            ['question_id' => 11, 'response' => 'Gabriel García Márquez', 'is_correct' => 1],
            ['question_id' => 11, 'response' => 'Julio Cortázar', 'is_correct' => 0],

            // Pregunta 12
            ['question_id' => 12, 'response' => 'República Checa', 'is_correct' => 1],
            ['question_id' => 12, 'response' => 'Austria', 'is_correct' => 0],
            ['question_id' => 12, 'response' => 'Polonia', 'is_correct' => 0],
            ['question_id' => 12, 'response' => 'Hungría', 'is_correct' => 0],
            ['question_id' => 12, 'response' => 'Alemania', 'is_correct' => 0],

            // Pregunta 13
            ['question_id' => 13, 'response' => 'Buenos Aires', 'is_correct' => 1],
            ['question_id' => 13, 'response' => 'Lima', 'is_correct' => 0],
            ['question_id' => 13, 'response' => 'Montevideo', 'is_correct' => 0],
            ['question_id' => 13, 'response' => 'Santiago', 'is_correct' => 0],
            ['question_id' => 13, 'response' => 'Asunción', 'is_correct' => 0],

            // Pregunta 14
            ['question_id' => 14, 'response' => 'Pablo Picasso', 'is_correct' => 1],
            ['question_id' => 14, 'response' => 'Salvador Dalí', 'is_correct' => 0],
            ['question_id' => 14, 'response' => 'Vincent van Gogh', 'is_correct' => 0],
            ['question_id' => 14, 'response' => 'Claude Monet', 'is_correct' => 0],
            ['question_id' => 14, 'response' => 'Francisco de Goya', 'is_correct' => 0],

            // Pregunta 15
            ['question_id' => 15, 'response' => '1977', 'is_correct' => 1],
            ['question_id' => 15, 'response' => '1980', 'is_correct' => 0],
            ['question_id' => 15, 'response' => '1973', 'is_correct' => 0],
            ['question_id' => 15, 'response' => '1965', 'is_correct' => 0],
            ['question_id' => 15, 'response' => '1983', 'is_correct' => 0],

            // Pregunta 16
            ['question_id' => 16, 'response' => 'Ottawa', 'is_correct' => 1],
            ['question_id' => 16, 'response' => 'Toronto', 'is_correct' => 0],
            ['question_id' => 16, 'response' => 'Vancouver', 'is_correct' => 0],
            ['question_id' => 16, 'response' => 'Montreal', 'is_correct' => 0],
            ['question_id' => 16, 'response' => 'Ottawa', 'is_correct' => 0],

            // Pregunta 17
            ['question_id' => 17, 'response' => 'Termómetro', 'is_correct' => 1],
            ['question_id' => 17, 'response' => 'Barómetro', 'is_correct' => 0],
            ['question_id' => 17, 'response' => 'Manómetro', 'is_correct' => 0],
            ['question_id' => 17, 'response' => 'Higrómetro', 'is_correct' => 0],
            ['question_id' => 17, 'response' => 'Altímetro', 'is_correct' => 0],

            // Pregunta 18
            ['question_id' => 18, 'response' => 'Vincent van Gogh', 'is_correct' => 1],
            ['question_id' => 18, 'response' => 'Claude Monet', 'is_correct' => 0],
            ['question_id' => 18, 'response' => 'Salvador Dalí', 'is_correct' => 0],
            ['question_id' => 18, 'response' => 'Pablo Picasso', 'is_correct' => 0],
            ['question_id' => 18, 'response' => 'Edvard Munch', 'is_correct' => 0],

            // Pregunta 19
            ['question_id' => 19, 'response' => 'Rómulo Augusto', 'is_correct' => 1],
            ['question_id' => 19, 'response' => 'Julio César', 'is_correct' => 0],
            ['question_id' => 19, 'response' => 'Tiberio', 'is_correct' => 0],
            ['question_id' => 19, 'response' => 'Augusto', 'is_correct' => 0],
            ['question_id' => 19, 'response' => 'Nerva', 'is_correct' => 0],

            // Pregunta 20
            ['question_id' => 20, 'response' => 'Oxígeno', 'is_correct' => 1],
            ['question_id' => 20, 'response' => 'Hidrógeno', 'is_correct' => 0],
            ['question_id' => 20, 'response' => 'Nitrógeno', 'is_correct' => 0],
            ['question_id' => 20, 'response' => 'Dióxido de carbono', 'is_correct' => 0],
            ['question_id' => 20, 'response' => 'Argón', 'is_correct' => 0],
        ]);
    }
}
