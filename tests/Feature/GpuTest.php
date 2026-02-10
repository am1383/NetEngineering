<?php

namespace Tests\Feature;

use Tests\TestCase;

class GpuTest extends TestCase
{
    public function test_get_gpus(): void
    {
        $this->seed('GpuSeeder');

        $response = $this->get('/api/v1/gpus');

        $response->assertOk()
            ->assertJsonCount(3, 'data');
    }
}
