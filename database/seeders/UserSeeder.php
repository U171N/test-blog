<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       // Buat pengguna admin
       DB::table('users')->insert([
        'name' => 'admin',
        'email' => 'admin@example.com',
        'username' => 'admin',
        'password' => Hash::make('admin'),
        'role' => 'admin',
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    // Buat pengguna author
    DB::table('users')->insert([
        'name' => 'author',
        'email' => 'author@example.com',
        'username' => 'author',
        'password' => Hash::make('author'),
        'role' => 'author',
        'created_at' => now(),
        'updated_at' => now(),
    ]);
    }
}
