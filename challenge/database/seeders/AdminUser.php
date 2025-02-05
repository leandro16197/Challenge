<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
class AdminUser extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'rol' => 1,
            'image' =>null,
            'localidad' => 'Tandil',
            'password' => Hash::make('pasword123'), 
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
