<?php

namespace Tests\Feature;

use Tests\TestCase;

class GpuTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->seed('GpuSeeder');
    }

    public function test_get_gpus(): void
    {
        $response = $this->get(route('index.gpu'));

        $response->assertOk()
            ->assertJsonCount(3, 'data');
    }
}
