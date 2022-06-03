<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'email' => 'rendi@gmail.com',
            'password' => 'rendi123',
            'name' => 'Rendi Julianto',
            'password' => Hash::make('rendi123')
        ]);
        User::create([
            'email' => 'admin@gmail.com',
            'password' => 'admin',
            'name' => 'admin',
            'password' => Hash::make('password')
        ]);
    }
}