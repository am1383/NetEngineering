<?php

namespace Tests\Feature;

use Tests\TestCase;

class CpuTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->seed('CpuSeeder');
    }

    public function test_get_cpus(): void
    {
        $response = $this->get(route('index.cpu'));

        $response->assertOk()
            ->assertJsonCount(3, 'data');
    }
}
