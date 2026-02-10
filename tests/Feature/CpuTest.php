<?php

namespace Tests\Feature;

use Tests\TestCase;

class CpuTest extends TestCase
{
    public function test_get_cpus(): void
    {
        $this->seed('CpuSeeder');

        $response = $this->get('/api/v1/cpus');

        $response->assertOk()
            ->assertJsonCount(3, 'data');
    }
}
