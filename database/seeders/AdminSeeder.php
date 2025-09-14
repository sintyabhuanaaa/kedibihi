<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;

class AdminSeeder extends Seeder
{
    public function run()
    {
        Admin::create([
            'name' => 'Admin Default',
            'email' => 'admin@example.com',
            'password' => Hash::make('password123'), // password default: password123
        ]);
    }
}
