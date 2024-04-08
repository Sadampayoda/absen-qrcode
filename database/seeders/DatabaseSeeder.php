<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        User::create([
            'name' => 'admin',
            'token_absen' => 'uwcucurcuuvcvur',
            'email' => 'admin@gmail.com',
            'nim' => 12345,
            'password' => bcrypt('123456'),
            'level' => 'admin'
        ]);
        User::create([
            'name' => 'dosen',
            'token_absen' => 'jwujbuwb',
            'email' => 'dosen@gmail.com',
            'nim' => 12342,
            'password' => bcrypt('123456'),
            'level' => 'dosen'
        ]);
        
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
