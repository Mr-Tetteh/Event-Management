<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'first_name' => 'Daniel',
            'last_name' => 'Tetteh',
            'role' => 'superAdmin',
            'contact' => '0559724772',
            'email' => 'danielstay73@gmail.com',
            'password' => Hash::make('eventmanagement1234?'),
            'created_at' => now(),
            'updated_at' => now(),
            
        ]);    }
}
