<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            [
                'email' => 'admin@example.com',
            ],
            [
                'name' => 'System Admin',
                'phone_number' => '+989183121519',
                'password' => 'admin12345',
                'role_id' => Role::where('name', 'user')
                    ->value('id'),
            ]
        );
    }
}
