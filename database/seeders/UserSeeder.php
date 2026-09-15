<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin Tester',
            'email' => 'admin@a.a',
            'password' => Hash::make('aaaaaaaa'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Normal User',
            'email' => 'user@a.a',
            'password' => Hash::make('aaaaaaaa'),
            'role' => 'user',
        ]);
    }
}