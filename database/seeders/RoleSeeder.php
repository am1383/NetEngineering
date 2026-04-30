<?php

namespace Database\Seeders;

use App\Enums\RoleType;
use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create([
            'id' => RoleType::ADMIN->value,
            'name' => 'admin',
        ]);

        Role::create([
            'id' => RoleType::USER->value,
            'name' => 'user',
        ]);
    }
}
