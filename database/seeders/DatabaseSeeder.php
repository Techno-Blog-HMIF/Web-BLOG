<?php

namespace Database\Seeders;

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
        User::create([
            'username' => 'admin',
            'name' => 'Jokowi',
            'email' => 'jokowi@gmail.com',
            'role' => 'admin',
            'password' => bcrypt('password'),
        ]);

        User::create([
            'username' => 'lee',
            'name' => 'lee',
            'email' => 'lee@gmail.com',
            'role' => 'user',
            'password' => bcrypt('password'),
        ]);
    }
}
