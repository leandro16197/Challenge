<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Carbon\Carbon;

class UsersAndVidaRankingSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        foreach (range(1, 10) as $index) {
            // Insertar en la tabla users
            $user = DB::table('users')->insertGetId([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'rol' => $faker->randomElement(['1', '2']),
                'username' => $faker->userName,
                'profile_picture' => $faker->imageUrl(100, 100),
                'email_verified_at' => now(),
                'password' => Hash::make('password'), 

                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Insertar en la tabla vida
            DB::table('vidas')->insert([
                'vidas' => $faker->numberBetween(1,5), 
                'user_id' => $user, 
                'last_updated' => Carbon::now(),
                'max_vidas' => 5, 
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

            // Insertar en la tabla ranking
            DB::table('ranking')->insert([
                'points' => $faker->numberBetween(100, 1000), 
                'id_user' => $user, 
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
