<?php

namespace Tests\Feature;

use App\Models\Gpu;
use Tests\TestCase;

class GpuTest extends TestCase
{
    public function test_get_gpus(): void
    {
        Gpu::factory()->count(3)->create();

        $response = $this->get(route('gpus.index'));

        $response->assertOk()
            ->assertJsonCount(3, 'data');
    }
}
