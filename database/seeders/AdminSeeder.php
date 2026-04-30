<?php

namespace Database\Seeders;

use App\Enums\RoleType;
use App\Models\User;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
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
                'password' => '1451383@Sm',
                'role_id' => RoleType::ADMIN->value
            ]
        );
    }
}
