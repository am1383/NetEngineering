<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Test User',
            'email' => 'user@example.com',
            'phone_number' => '+989183121517',
            'password' => 'password',
            'role' => 'user',
        ]);
    }
}
