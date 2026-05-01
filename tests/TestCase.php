<?php

namespace Tests;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Laravel\Passport\Passport;

abstract class TestCase extends BaseTestCase
{
    use RefreshDatabase;

    protected function actingAsAdmin(): void
    {
        Passport::actingAs(User::factory()->admin()
            ->create()
        );
    }

    protected function actingAsUser(): void
    {
        Passport::actingAs(User::factory()->user()
            ->create()
        );
    }
}
