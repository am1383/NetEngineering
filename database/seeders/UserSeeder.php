<?php

namespace Database\Seeders;

use App\Models\Role;
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
            'name' => 'Test user',
            'email' => 'user@example.com',
            'phone_number' => '+989183121516',
            'password' => 'password',
            'role_id' => Role::where('name', 'user')
                ->value('id'),
        ]);

        User::create([
            'name' => 'Test admin user',
            'email' => 'am205379@gmail.com',
            'phone_number' => '+989183121517',
            'password' => 'password',
            'role_id' => Role::where('name', 'admin')
                ->value('id'),
        ]);
    }
}
