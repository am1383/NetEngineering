<?php

namespace Tests\Feature;

use App\Models\Cpu;
use Tests\TestCase;

class CpuTest extends TestCase
{
    public function test_get_cpus(): void
    {
        Cpu::factory()->count(3)->create();

        $response = $this->get(route('cpus.index'));

        $response->assertOk()
            ->assertJsonCount(3, 'data');
    }
}
