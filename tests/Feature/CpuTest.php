<?php

namespace Tests\Feature;

use App\Models\Cpu;
use Tests\TestCase;

class CpuTest extends TestCase
{
    public function test_get_cpus(): void
    {
        Cpu::factory()->count(3)->create();

        $response = $this->getJson(route('cpus.index'));

        $response->assertOk()
            ->assertJsonCount(3, 'data');
    }

    public function test_get_cpus_when_empty(): void
    {
        $response = $this->getJson(route('cpus.index'));

        $response->assertOk()
            ->assertJsonCount(0, 'data');
    }

    public function test_cpus_pagination_works_correctly(): void
    {
        Cpu::factory()->count(30)->create();

        $response = $this->getJson(route('cpus.index') . '?page=1&per_page=10');

        $response->assertOk()
            ->assertJsonCount(10, 'data');
    }
}
