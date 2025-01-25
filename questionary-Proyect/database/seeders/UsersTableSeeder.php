<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        foreach (range(1, 10) as $index) {
            DB::table('users')->insert([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'rol' => $faker->randomElement(['admin', 'user']),
                'username' => $faker->userName,
                'profile_picture' => $faker->imageUrl(100, 100),
                'email_verified_at' => now(),
                'password' => Hash::make('password'), 
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
