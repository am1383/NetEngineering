<?php

namespace Tests\Feature;

use App\Models\Gpu;
use Tests\TestCase;

class GpuTest extends TestCase
{
    public function test_get_gpus(): void
    {
        Gpu::factory()->count(3)->create();

        $response = $this->getJson(route('gpus.index'));

        $response->assertOk()
            ->assertJsonCount(3, 'data');
    }

    public function test_get_gpus_when_empty(): void
    {
        $response = $this->getJson(route('gpus.index'));

        $response->assertOk()
            ->assertJsonCount(0, 'data');
    }

    public function test_gpus_pagination_works_correctly(): void
    {
        Gpu::factory()->count(30)->create();

        $response = $this->getJson(route('gpus.index') . '?page=1&per_page=10');

        $response->assertOk()
            ->assertJsonCount(10, 'data');
    }
}
